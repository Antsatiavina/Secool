@extends("layouts.master")

@section("contenu")
<section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                @if (session('insert_success'))
                    <div class="alert alert-success m-2 p-2">
                        <strong>Succès!</strong> {{ session('insert_success') }}
                    </div>
                @elseif (session('delete_success'))
                    <div class="alert alert-success m-2 p-2">
                        <strong>Succès!</strong> {{ session('delete_success') }}
                    </div>
                @elseif (session('modify_success'))
                    <div class="alert alert-success m-2 p-2">
                        <strong>Succès!</strong> {{ session('modify_success') }}
                    </div>
                @endif
                    <table class="datatables-basic table">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>id</th>
                                <th>id</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Classe</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($etudiants as $etu )
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ $etu->id }}</td>
                                <td>{{ $etu->nom }}</td>
                                <td>{{ $etu->prenom }}</td>
                                <td>{{ $etu->classe_id }}</td>
                                <td>
                                    <a href="/supprimer/{{ $etu->id }}" title="Supprimer"><i data-feather="trash" class="text-danger"></i></a>
                                    &nbsp
                                    <a href="" data-bs-toggle="modal" data-bs-target="#modals-slide-in" title="Modifier" onclick="modifier({{ $etu->id }},'{{ $etu->nom }}','{{ $etu->prenom }}',{{ $etu->classe_id }})"><i data-feather="edit" class="text-primary"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Modal to add new record -->
        <div class="modal modal-slide-in fade" id="modals-slide-in">
            <div class="modal-dialog sidebar-sm">
                <form class="add-new-record modal-content pt-0" id="form" action="{{ route('ajouter_etudiant') }}" method="post">
                @csrf
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                    <div class="modal-header mb-1">
                        <h5 class="modal-title" id="exampleModalLabel">Nouvel étudiant</h5>
                    </div>
                    <div class="modal-body flex-grow-1">
                        <div class="mb-1">
                            <label class="form-label" for="basic-icon-default-fullname">Nom</label>
                            <input type="text" name="nom" class="form-control dt-full-name" id="nom" placeholder="John Doe" aria-label="John Doe" required/>
                            <span style="color:red">@error('nom')
                                {{ $message }}
                            @enderror</span>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="basic-icon-default-fullname">Prenom</label>
                            <input type="text" name="prenom" class="form-control dt-full-name" id="prenom" placeholder="......." required />
                            <span style="color:red">@error('prenom')
                                {{ $message }}
                            @enderror</span>
                        </div>
                        <div class="mb-4">
                            <select class="form-select" id="classe" name="classe" required>
                                <option value="">Choisissez la classe</option>
                                @foreach ($classes as $classe)
                                    <option value="{{ $classe->id }}">{{  $classe->libelle }}</option>
                                @endforeach
                            </select>
                            <span style="color:red">@error('classe')
                                {{ $message }}
                            @enderror</span>
                        </div>
                        <button type="submit" id="bouton_formulaire" class="btn btn-primary data-submit me-1">Ajouter</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @section("script")
        <script>
            
            function modifier($id, $nom ,$prenom, $classe){
                $("input#nom").val($nom);
                $("input#prenom").val($prenom);
                $("select#classe").val($classe);
                $("#bouton_formulaire").text("Modifier");
                $("#exampleModalLabel").text("Modifier un étudiant")
                $("form#form").removeAttr('action');
                $("form#form").attr('action','/modifier/'+$id);
            }
        </script>
    @endsection
@endsection