{{ Form::open(['url' => 'roles', 'method' => 'post', 'class'=>'needs-validation', 'novalidate']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group">
            {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}<x-required></x-required>
            <div class="form-icon-user">
                {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Role Name'),'required'=>'required']) }}
            </div>

            @error('name')
                <span class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="form-group">
            @if (!empty($permissions))
                <h6 class="mb-2">{{ __('Assign Permission to Roles') }} </h6>
                <table class="table  mb-0" id="dataTable-1">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="align-middle checkbox_middle form-check-input"
                                    name="checkall" id="checkall">
                            </th>
                            <th>{{ __('Module') }} </th>
                            <th>{{ __('Permissions') }} </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php

                        $modules = [
                            'Tableau de bord' => 'Dashboard',
                            'Themes' => 'Themes',
                            'Roles' => 'Role',
                            'Utilisateur' => 'User',
                            'Point tp' => 'Pos',
                            'Point de Point' => 'Location',
                            'Boutique' => 'Products',
                            'Commandes' => 'Orders',
                            'Stockage de Parametres' => 'Store',
                         ];

                        // Définir les autorisations pour chaque module (en utilisant les permissions existantes)
                        $modulePermissions = [
                            'Dashboard' => ['Manage'],
                            'Themes' => ['Manage', 'Edit'],
                            'Role' => ['Manage', 'Create', 'Delete', 'Edit'],
                            'User' => ['Manage', 'Create', 'Delete', 'Edit'],
                            'Pos' => ['Manage', 'Create'],
                            'Location' => ['Manage', 'Create', 'Delete', 'Edit'],
                            'Products' => ['Manage', 'Create', 'Delete', 'Show', 'Edit'],
                            'Orders' => ['Manage', 'Show', 'Delete'],
                            'Store' => ['Manage', 'Create', 'Delete', 'Edit'],
                        ];

                        @endphp
                        @foreach ($modules as $displayName => $moduleName)
                            <tr>
                                <td><input type="checkbox" class="align-middle ischeck form-check-input"
                                        name="checkall" data-id="{{ str_replace(' ', '', $moduleName) }}"></td>
                                <td><label class="ischeck form-label"
                                        data-id="{{ str_replace(' ', '', $moduleName) }}">{{ ucfirst($displayName) }}</label>
                                </td>
                                <td>
                                    <div class="row">
                                        @php
                                            $moduleId = str_replace(' ', '', $moduleName);
                                            $currentPermissions = $modulePermissions[$moduleName] ?? [];
                                        @endphp
                                        
                                        @foreach ($currentPermissions as $permission)
                                            @php
                                                $permissionKey = $permission . ' ' . $moduleName;
                                                $permissionId = 'permission_' . $moduleId . '_' . str_replace(' ', '', $permission);
                                                // Chercher l'ID de la permission dans la base de données
                                                $permissionDbId = array_search($permissionKey, (array) $permissions);
                                            @endphp
                                            @if ($permissionDbId !== false)
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    {{ Form::checkbox('permissions[]', $permissionDbId, false, ['class' => 'form-check-input isscheck isscheck_' . $moduleId, 'id' => $permissionId]) }}
                                                    {{ Form::label($permissionId, ucfirst($permission), ['class' => 'form-label font-weight-500']) }}<br>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
<div class="modal-footer d-flex pt-0 mb-0 justify-content-end col-form-label">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
    <input type="submit" value="{{ __('Create') }}" class="btn  btn-primary">
</div>
{{ Form::close() }}

<script>
    $(document).ready(function() {
        $("#checkall").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $(".ischeck").click(function() {
            var ischeck = $(this).data('id');
            $('.isscheck_' + ischeck).prop('checked', this.checked);
        });
    });
</script>
