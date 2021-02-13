<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MemberRole;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{

    protected $model;
    protected $roleModel;

    function __construct(Member $model, MemberRole $roleModel)
    {
        $this->model = $model;
        $this->roleModel = $roleModel;
    }

    public function index()
    {
        return view('members.index', [
            'members' => $this->model::all()
        ]);
    }

    public function create()
    {
        return view('members.form', [
            'member' => $this->getNewMember(),
            'roles' => $this->roleModel::all()
        ]);
    }


    public function store(Request $request)
    {
      $member = new Member($request->all());
      $valid = $this->validateRequest($request);

    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    private function getNewMember()
    {
        return (new Member(['enable' => TRUE]));
    }

    private function validateRequest(Request $request, Member $member=NULL)
    {
        return $request->validate([
          'email' => [
            'required', 
            'email'/*,
            Rule::unique('member', 'email')->ignore($member->id)*/
        ],
        'enable' => ['required', 'bool'],
        'name' => ['required'],
        'phone' => ['required'],
        'address' => ['required'],
        'role_id' => ['required'],
        ]);
    }
}
