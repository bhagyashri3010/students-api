<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Student;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
	public function __construct()
	{

	}

	public function create_student(Request $request)
	{
		$validation = Validator::make($request->all(),[
			'name' => 'required',
			'email' => 'required|email',
			'calling_code'	=> 'required',
			'phone_number' => 'required'
		]);

		if ($validation->fails()) {
			return response($validation->messages(), 200);
		} else {
			$country = json_decode(file_get_contents("https://restcountries.eu/rest/v2/callingcode/".$request->calling_code), true);
			$country_name = $country[0]['name'];
			$country_code = $country[0]['alpha2Code'];

			$student = Student::create([
				'name'		=> $request->name,
				'email'		=> $request->email,
				'phone_number' => $request->phone_number,
				'country' 		=> $country_name,
				'country_code'   => $country_code
			]);

			return response()->json([
				"message" => "student record created"
			], 200);
		}
	}

	public function get_student(Request $request)
	{
		$value = $request->input('value');
		$student = Student::where('name','like', '%' . $value . '%')->paginate(10);

		return response()->json([
			"data" => $student->appends(request()->except('page')),
			"message" => "Record found"
		], 200);
	}

	public function get_student_by_id($id)
	{
		if (!is_numeric($id)) {
			return response()->json([
				"message" => "Invalid input"
			], 400);
		} else {
			$student = Student::where('id', $id)->get()->toArray();
			return response()->json([
				"data" => $student,
				"message" => "Record found"
			], 200);
		}
	}
}
