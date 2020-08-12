@php /** @var User $user */use App\Models\User;@endphp
<div class="content-block__item">
    <button onclick="location.href='{{ route('cabinet.profile.edit') }}'"
            class="btn btn-outline btn-go-on">{{ __('Edit') }}</button>
</div>
<table class="table">
    <thead>
    <th>{{ __('LastName') }}</th>
    <th>{{ __('Name') }}</th>
    <th>{{ __('MiddleName') }}</th>
    <th>{{ __('Email') }}</th>
    <th>{{ __('Phone') }}</th>
    <th>{{ __('DeliveryUserAddress') }}</th>
    </thead>
    <tbody>
    <tr>
        <td>{{ $user->last_name }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->middle_name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->phone }}</td>
        <td>{{ $user->delivery_place }}</td>
    </tr>
    </tbody>
</table>

