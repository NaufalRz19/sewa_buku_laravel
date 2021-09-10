@extends('layout.master')

@section('content')
<div class="container">
    <h4>Edit Peminjam</h4>
    <form action="{{ route('user.update', $user->id) }}" method="post">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" value="{{ $user->email }}" class="form-control">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input id="password" type="text" name="password" value="{{ $user->password }}" class="form-control @error('password') is-invalid @enderror"
            required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
        <div class="form-group">
            <label>{{ __('Confirm Password') }}</label>
            <input type="password" name="password_confirmation" id="password-confirm" class="form-control"
            value="{{ $user->password }}" required autocomplete="new-password">
        </div>
        <div class="form-group">
            <label>Level</label>
            <select name="level" class="form-control">
                <option>Pilih Level</option>
                <option value="admin" <?php if($user->level == "admin") echo 'selected="selected"'; ?>>Admin</option>
                <option value="peminjam" <?php if($user->level == "peminjam") echo 'selected="selected"'; ?>>Peminjam</option>
            </select>
        </div>
        <div><button type="submit">Update</button></div>
    </form>
</div>
@endsection
