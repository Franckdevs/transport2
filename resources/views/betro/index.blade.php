<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="mb-0">Liste des employés</h5>
                <a href="{{ route('employee.create') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i> Ajouter un employé
                </a>
            </div>

            <!-- Barre de recherche personnalisée -->
            <div class="mb-3" style="max-width: 300px;">
                <input type="text" id="customSearchEmployee" class="form-control" placeholder="Rechercher un employé...">
            </div>

            <!-- Tableau -->
            <table id="employeeTable" class="table display nowrap table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Fonction</th>
                        <th>Date de création</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->nom }}</td>
                        <td>{{ $employee->prenom }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->fonction }}</td>
                        <td>{{ \App\Helpers\GlobalHelper::formatCreatedAt($employee->created_at) }}</td>
                        <td>
                            <a href="{{ route('employee.show', $employee->id) }}" class="btn btn-info btn-sm">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- DataTables 2.x JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const table = new DataTable('#employeeTable');
    const searchInput = document.getElementById('customSearchEmployee');
    searchInput.addEventListener('input', function() {
        table.search(this.value);
    });
});
</script>
