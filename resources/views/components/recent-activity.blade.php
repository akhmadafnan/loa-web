@foreach ($logs as $log)
<div class="d-flex align-items-start border-left-line pb-3">
    <div>
        <a href="javascript:void(0)" class="btn btn-cyan btn-circle mb-2 btn-item">
            <i data-feather="bell"></i>
        </a>
    </div>
    <div class="ms-3 mt-2">
        <h5 class="text-dark font-weight-medium mb-2">
            Aktivitas: {{ ucfirst($log->action ?? 'log') }}
        </h5>
        <p class="font-14 mb-2 text-muted">
            {{ $log->description ?? '-' }}
        </p>
        <span class="font-weight-light font-14 text-muted">
            {{ $log->created_at->diffForHumans() }}
        </span>
    </div>
</div>
@endforeach
