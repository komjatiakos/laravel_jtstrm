<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Welcome back, <b>{{ Auth::user()->name }}</b>
            <b style="float:right">Total users: {{  count($users)  }}</b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Serial Number</th>
                        <th scope="col">User Name</th>
                        <th scope="col">User Email</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Created At Time Stamp</th>
                      </tr>
                    </thead>
                    <tbody>
                    @php($i =1)
                    @foreach ($users as $user)
                      <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <!-- <td>$user->created_at->diffForHumans()*/</td> ORM -->
                        <td>{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                        <td>{{ $user->created_at }}</td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</x-app-layout>
