<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Core;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Users\CreateRequest;
use Illuminate\Http\Response;
use Illuminate\View\View;

class UsersController extends Core
{
    /**
     * @var array
     */
    private  $data = [];
    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->data['pages'] = $this->pageRepository->getAllPagesNav();
        $this->data['productCategories'] = $this->productCategoryRepository->getAllProductCategories();
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $users = $this->userRepository->getAllWithPaginate(20);
        return view('admin.users.index', compact('users'), $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return Response
     */
    public function store(CreateRequest $request): Response
    {
        $user = User::new(
            $request['name'],
            $request['email'],
            $request['phone']
        );

        return redirect()->route('admin.users.show', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user): Response
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user): Response
    {
        //$roles = User::rolesList();

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param User $user
     * @return Response
     */
    public function update(UpdateRequest $request, User $user): Response
    {
        $user->update($request->only(['name', 'email', 'phone']));

//        if ($request['role'] !== $user->role) {
//            $user->changeRole($request['role']);
//        }

        return redirect()->route('admin.users.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     * @throws Exception
     */
    public function destroy(User $user): Response
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
