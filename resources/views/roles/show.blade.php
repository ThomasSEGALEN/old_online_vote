<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('roles.index') }}" class="inline-flex justify-center items-center mr-2">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>
        </a>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($role->name) }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative p-6 bg-white border-b border-gray-200">
                    <div class="absolute top-4 right-4">
                        @can ('update', $role)
                        <a href="{{ route('roles.edit', $role) }}" class="inline-flex justify-center items-center p-2 text-base font-medium text-gray-500 bg-gray-50 rounded-lg hover:text-gray-900 hover:bg-gray-100">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                        </a>
                        @endcan
                        @can ('delete', $role)
                            <form class="inline-flex justify-center items-center p-2 text-base font-medium text-gray-500 bg-gray-50 rounded-lg hover:text-gray-900 hover:bg-gray-100" id="form-{{ $role->id }}" action="{{ route('roles.destroy', $role) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit">
                                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                </button>
                            </form>
                        @endcan
                    </div>
                    <div>
                        <div class="flex flex-col">
                            <span class="mb-4">{{ $role->name }}</span>
                            @if ($role->users->first())
                            <div>
                                <span>Utilisateurs :</span>
                                @foreach ($role->users->sortBy('last_name') as $user)
                                @if (auth()->user()->can('view', $user))
                                <li><a href="{{ route('users.show', $user) }}">{{ $user->last_name }} {{ $user->first_name }}</a></li>
                                @else
                                <li>{{ $user->last_name }} {{ $user->first_name }}</li>
                                @endif
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <div class="flex flex-col space-y-2">
                            @if ($role->permissions->first())
                            <span>Permissions :</span>
                            @foreach ($role->permissions->sortBy('id') as $key => $permission)
                                @if ($permission->id === \App\Models\Permission::USERS_VIEW_ANY || $permission->id === \App\Models\Permission::ROLES_VIEW_ANY || $permission->id === \App\Models\Permission::GROUPS_VIEW_ANY)
                                <span
                                    class="w-fit text-xs inline-flex font-bold leading-sm uppercase px-3 py-1 bg-gray-200 text-gray-700 rounded-full"
                                >
                                    <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c5.2-11.8 8-24.8 8-38.5c0-53-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zm223.1 298L83.1 161.5c-11 14.4-20.5 28.7-28.4 42.2l339 265.7c18.7-5.5 36.2-13 52.6-21.8zM34.5 268.3c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c3.1 0 6.1-.1 9.2-.2L33.1 247.8c-1.8 6.8-1.3 14 1.4 20.5z"/></svg>
                                    {{ $permission->name }}
                                </span>
                                @endif
                                @if ($permission->id === \App\Models\Permission::USERS_VIEW || $permission->id === \App\Models\Permission::ROLES_VIEW || $permission->id === \App\Models\Permission::GROUPS_VIEW)
                                <div
                                    class="w-fit text-xs inline-flex font-bold leading-sm uppercase px-3 py-1 bg-blue-200 text-blue-700 rounded-full"
                                >
                                    <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM432 256c0 79.5-64.5 144-144 144s-144-64.5-144-144s64.5-144 144-144s144 64.5 144 144zM288 192c0 35.3-28.7 64-64 64c-11.5 0-22.3-3-31.6-8.4c-.2 2.8-.4 5.5-.4 8.4c0 53 43 96 96 96s96-43 96-96s-43-96-96-96c-2.8 0-5.6 .1-8.4 .4c5.3 9.3 8.4 20.1 8.4 31.6z"/></svg>
                                    {{ $permission->name }}
                                </div>
                                @endif
                                @if ($permission->id === \App\Models\Permission::USERS_CREATE || $permission->id === \App\Models\Permission::ROLES_CREATE || $permission->id === \App\Models\Permission::GROUPS_CREATE)
                                <div
                                    class="w-fit text-xs inline-flex font-bold leading-sm uppercase px-3 py-1 bg-green-200 text-green-700 rounded-full"
                                >
                                    <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
                                    {{ $permission->name }}
                                </div>
                                @endif
                                @if ($permission->id === \App\Models\Permission::USERS_UPDATE || $permission->id === \App\Models\Permission::ROLES_UPDATE || $permission->id === \App\Models\Permission::GROUPS_UPDATE)
                                <div
                                    class="w-fit text-xs inline-flex font-bold leading-sm uppercase px-3 py-1 bg-yellow-200 text-yellow-700 rounded-full"
                                >
                                <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>                                {{ $permission->name }}
                                </div>
                                @endif
                                @if ($permission->id === \App\Models\Permission::USERS_DELETE || $permission->id === \App\Models\Permission::ROLES_DELETE || $permission->id === \App\Models\Permission::GROUPS_DELETE)
                                <div
                                    class="w-fit text-xs inline-flex font-bold leading-sm uppercase px-3 py-1 bg-red-200 text-red-700 rounded-full"
                                >
                                    <svg class="w-4 h-4 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"/></svg>
                                    {{ $permission->name }}
                                </div>
                                @endif
                            @endforeach                      
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
