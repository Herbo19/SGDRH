<!-- Nav Item - Messages -->
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="{{ url('/chatify') }}" id="messagesDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-envelope fa-fw"></i>
        <!-- Counter - Messages -->
        <span class="badge badge-danger badge-counter">0</span>
    </a>
    <!-- Dropdown - Messages -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header">
            Centro de Mensagens
        </h6>
        <a class="dropdown-item text-center small text-gray-500" target="_blank" href="{{ url('chatify') }}">Ver mais mensagens</a>
    </div>
</li>
