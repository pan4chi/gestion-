@extends('layouts.admin')
@section('title', $title)
@section('content')


    @if (session('success_msg'))
        <div class="fixed bottom-0 right-0 m-4 z-50">
            <div id="success-alert"
                class="bg-green-500 text-white font-bold rounded-lg px-4 py-3 shadow-md flex items-center justify-between">
                <span>{{ session('success_msg') }}</span>
                <button id="close-alert"
                    class="text-white hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-400 rounded-full">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    @endif
    @if ($errors->any())
        <div class="fixed bottom-0 right-0 m-4">
            <div id="fail-alert"
                class=" relative bg-red-500 text-white font-bold rounded-lg px-4 py-3 shadow-md flex items-center justify-between">
                <div class="flex flex-col p-3 ">

                    @foreach ($errors->all() as $err)
                        <span>{{ $err }}</span>
                    @endforeach
                </div>
    @endif
    <section class="is-title-bar relative">
        <div class="flex flex-col md:flex-row items-center justify-between  md:space-y-0">
            <ul>
                <li>Admin</li>
                <li>Les Demandes de Congés</li>
            </ul>
        </div>
    </section>

    <div class="  bg-white shadow-lg rounded-sm border border-gray-200">

        <div class="p-3">
            <div class="overflow-x-auto resp">
                <table class="table-auto w-full">
                    <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                        <tr>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">Nom complet</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">date début</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">date Fin</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-center">Totale des Jours</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-center">Type de Congés</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-center">Statuts</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-center">Actions</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @foreach ($leaves as $leave)
                            <tr>
                                <td data-label="nom complet" class="p-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3"><img class="rounded-full"
                                                src={{ "https://avatars.dicebear.com/v2/initials/{$leave->employee->user->getFirstName()[0]}-{$leave->employee->user->getLastName()[0]}.svg" }}>
                                        </div>
                                        <div class="font-medium text-gray-800">
                                            {{ $leave->employee->user->getFirstName() }}
                                            {{ $leave->employee->user->getLastName() }}</div>
                                    </div>
                                </td>
                                <td data-label="date debut" class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{ $leave->getStartAt() }}</div>
                                </td>
                                <td data-label="date fin" class="p-2 whitespace-nowrap">
                                    <div class="text-left font-medium text-green-500">{{ $leave->getEndAt() }}</div>
                                </td>
                                <td data-label="Totale des Jours" class="p-2 whitespace-nowrap">
                                    <div class="text-lg text-center">{{ $leave->Days() }} jours</div>
                                </td>
                                <td data-label="le type de congee" class="p-2 whitespace-nowrap">
                                    <div class="text-lg text-center">{{ $leave->getType() }} </div>
                                </td>
                                <td data-label="status de congee" class="p-2 whitespace-nowrap">
                                    <div class="text-center">
                                        @if ($leave->status == 'accepted')
                                            <span
                                                class="text-white text-sm w-1/3 pb-1 bg-green-600 font-semibold px-2 rounded-full">
                                                Demande acceptée </span>
                                        @elseif($leave->status == 'rejected')
                                            <span
                                                class="text-white text-sm w-1/3 pb-1 bg-red-600 font-semibold px-2 rounded-full">
                                                Demande refusée </span>
                                        @else
                                            <span
                                                class="text-red-800 text-sm w-1/3 pb-1 bg-orange-200 font-semibold px-2 rounded-full">
                                                En cours de traitement </span>
                                        @endif
                                    </div>
                                </td>

                                <td data-label="le rest" class="p-2 whitespace-nowrap">
                                    <div class="flex justify-center">
                                        @if ($leave->status == 'rejected')
                                            <div class="m-1">
                                                <form action="{{ route('admin.leave.accept', $leave->getId()) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <button style="width: 30px"
                                                        class="bg-green-500 btn-accepted-leave hover:bg-green-600 text-white font-bold  rounded">
                                                        <i class="fa fa-check m-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @elseif($leave->status == 'accepted')
                                            <div class="m-1">

                                                <form action="{{ route('admin.leave.reject', $leave->getId()) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <button style="width: 30px" type="button"
                                                        class="bg-red-500 btn-rejected-leave hover:bg-red-600 text-white font-bold rounded">
                                                        <i class="fa fa-times m-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="m-1">
                                                <form action="{{ route('admin.leave.accept', $leave->getId()) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <button style="width: 30px"
                                                        class="bg-green-500 btn-accepted-leave hover:bg-green-600 text-white font-bold p-0 rounded">
                                                        <i class="fa fa-check m-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="m-1">

                                                <form action="{{ route('admin.leave.reject', $leave->getId()) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <button type="button" style="width: 30px"
                                                        class="bg-red-500 btn-rejected-leave hover:bg-red-600 text-white font-bold  p-0 rounded">
                                                        <i class="fa fa-times m-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>




@endsection




@section('script')
    <script>
        $(".btn-rejected-leave").click(function(e) {
                e.preventDefault()
                const form = $(this).parent()
                Swal.fire({
                    title: 'tu peut pas le droit de rechanger le status ?',
                    showDenyButton: true,
                    confirmButtonText: 'rejecter',
                    denyButtonText: `Annuler`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $(form).submit()

                    } else if (result.isDenied) {

                    }
                })
            }

        )
        $(".btn-accepted-leave").click(function(e) {
                e.preventDefault()
                const form = $(this).parent()
                Swal.fire({
                    title: 'tu peut pas le droit de rechanger le status ?',
                    showDenyButton: true,
                    confirmButtonText: 'accepter',
                    denyButtonText: `Annuler`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $(form).submit()

                    } else if (result.isDenied) {

                    }
                })
            }


        )
    </script>
@endsection
