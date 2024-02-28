<!-- Topbar Search -->
<form method="POST" action="{{ url('searchUser') }}"
class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
@csrf
<div class="input-group">

    <input type="search" required class="form-control bg-gray-200 border-0 small" placeholder="Pesquisar Usuário... "
        aria-label="search" id="search" name="user_box" aria-describedby="basic-addon2">
    <div class="input-group-append">
        <button class="btn btn-info" type="submit">
            <i class="fas fa-search fa-sm"></i>
        </button>
    </div>
</div>
</form>
