@extends('layouts.app')

@section('title')
    Accueil
@endsection

@section('content')

    <main>
        <div class="md:flex md:items-center bg-green-400 md:justify-between">
            <div class="flex-1 min-w-0 mr-4" >
              <h2 class=" font-bold leading-7 text-pink-600  ">
                Agenda Electronique
              </h2>
            </div>
            <div class="px-4 py-2 flex md:mt-0 md:ml-4">
              <button type="button" data-toggle="modal" data-target="#myModal" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500">
                Nouveau Evénement
              </button>
            </div>
        </div>

        <div class="relative mt-20">
            <div class="lg:mx-auto lg:max-w-7xl lg:px-8 lg:grid lg:gap-24 lg:items-start">
                <div id="eventTable"></div>
            </div>
        </div>

        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Ajouter un Evénement</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <form id="event_form" method="POST" action="{{ url('/event/create') }}">
                    @csrf
                    <input type="hidden" name="eventId" id="eventId"/>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="eventName">Titre<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="eventName" id="eventName" placeholder="Titre de l'événement"/>
                        </div>
                        @error('eventName')
                            <div class="invalid-feedback">{{ $message }}</div>
                         @enderror

                        <div class="col-md-6 mb-3 input-append date">
                            <label for="startDate">Date de debut <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="startDate" name="startDate"   value="<?php echo date('Y-m-d');?>" readonly/>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                        @error('startDate')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror


                        <div class="col-md-6 mb-3  date">
                            <label for="endDate">Date de fin <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="endDate" name="endDate"  value="<?php echo date('Y-m-d'); ?>" readonly/>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>

                        @error('endDate')
                           <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea  class="form-control" name="description" id="description" placeholder="Bien vouloir saisir la description de votre événement "></textarea>
                        </div>
                    </div>

                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror


                    <div class="row mb-10">
                        <div class="col-md-8">
                            <label for="participants">Intervenants : <span class="text-danger">*</span></label>
                            <input class="form-control" name="participants" id="participants" placeholder="Saisir les noms des Intervenants"/>
                        </div>
                        <div class="col-md-2 mt-7">
                            <button type="button" id="add_participants" class="bg-indigo-400 hover:bg-indigo-600 rounded-full px-2 py-2 font-bold text-white">Add</button>
                        </div>
                    </div>
                </form>
            </div>
              <div class="modal-footer">
                <button type="button" id="save_form" class="bg-green-400 rounded-full px-2 py-2 font-bold text-white">Enregistrer</button>
                <button type="button" class="bg-red-400 rounded-full px-2 py-2 font-bold text-white" data-dismiss="modal">Annuler</button>
              </div>
            </div>

          </div>
        </div>

        <div class="modal fade" id="ConfirmModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Confirmation de suppression
                        </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p> Voulez-vous supprimer definitivement cet événement ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="save_form" onclick="deleteEvent();" class="bg-red-400 hover:bg-red-600 rounded-full px-2 py-2 font-bold text-white">Enregistrer</button>
                        <button type="button" class="bg-gray-400 rounded-full px-2 py-2 font-bold text-white" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>

        <x-subscribe />
        <x-modals.description/>
        <x-form-delete/>
    </main>

    <x-footer />

@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"/>
    <link rel="stylesheet" href="ttps://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css"/>
@endpush

 @push('scripts')
     <script src="{{ asset('js/agenda.js') }}"></script>
@endpush
