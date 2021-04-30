<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageModel;
use Exception;
use Config;
use View;

class ManagementDashboardController extends Controller
{
	protected $_page;
	protected $_pageContent;

	public function __construct()
	{
		$this->_page = 'pages.';
		$this->_pageContent = Config::get('page');
	}

	public function index()
	{
		$page = PageModel::where('page','dashboard');

		return view('dashboard',[
			'template' => $this->_pageContent,
			'content' => (bool)$page->count()? $page->first()->content : '[]'
		]);
	}

	public function gettemplate($template)
	{
		try{
			return response()->json([
				'status' => true,
				'msg' => 'success',
				'data' => View::make($template)->render()
			]);
		}catch(Exception $e){
			return response()->json([
				'status' => false,
				'msg' => $e->getMessage(),
				'data' => []
			]);
		}
	}

	public function updatepage(Request $request)
	{
		try{
			PageModel::updateOrCreate(['page' => $request->input('page')],['content' => json_encode($request->input('content'))]);
			return response()->json([
				'status' => true,
				'msg' => 'success'
			]);
		}catch(Exception $e){
			return response()->json([
				'status' => false,
				'msg' => $e->getMessage()
			]);
		}
	}
}
