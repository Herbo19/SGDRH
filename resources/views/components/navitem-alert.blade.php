<!-- Nav Item - Alerts -->


@php
    $notifications = $user->unreadNotifications;
    $ncount  =0;
    foreach (auth()->user()->notifications as $notification){
        if(!$notification->read_at){
            $ncount+=1;
        }
    }
@endphp

<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alertas -->
        <span class="badge badge-danger badge-counter">{{ $ncount }}</span>
    </a>
    <!-- Dropdown - Alertas -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
            Centro de Notificações
        </h6>
        @foreach (auth()->user()->notifications as $notification)
        @if(!$notification->read_at)


            <a class="dropdown-item d-flex align-items-center notification"  href="{{ url('/mark-notification-as-read/'.$notification->id) }}">
                <div class="mr-3">
                    <div class="icon-circle bg-success">
                        <i class="fas fa-bullseye text-white"></i>
                    </div>
                </div>
                <div>
                    {{ $notification->data['message'] }}
                </div>
            </a>
            @endif
        @endforeach





        <a class="dropdown-item text-center small text-gray-500" href="#">Mostrar todas notificações</a>
    </div>
</li>
