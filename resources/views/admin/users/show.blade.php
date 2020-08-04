@extends('layouts.app')
@section('title', __('User') . ': ' . $user->name)

@section('content')
    <section id="admin-edit-user">
        <div class="container">
            <div class="admin-edit-user">
                @include('admin.users._nav')
                <h1>{{ __('User') . ': ' . $user->name }}</h1>
                @php /** @var User $user */use App\Models\User; @endphp
                <div class="nav-button">
                    <button onclick="window.location.href='{{ route('admin.users.edit', $user) }}'"
                            class="btn btn-active">{{ __('Edit') }}</button>
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="edit-user-form">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">{{ __('Delete') }}</button>
                    </form>
                </div>
            </div>

            <table class="table">
                <tbody>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <th>{{ __('Name') }}</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>{{ __('E-Mail Address') }}</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>{{ __('Phone') }}</th>
                    <td>{{ $user->phone }}</td>
                </tr>
                <tr>
                    <th>{{ __('Status') }}</th>
                    <td>
                        @if ($user->isWait())
                            <span class="badge-waiting">{{ __('Waiting') }}</span>
                        @endif
                        @if ($user->isActive())
                            <span class="badge-active">{{ __('Active') }}</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>{{ __('Role') }}</th>
                    <td>
                        @if ($user->isAdmin())
                            <span class="badge-admin">{{ __('Admin') }}</span>
                        @else
                            <span class="badge-user">{{ __('User') }}</span>
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection
