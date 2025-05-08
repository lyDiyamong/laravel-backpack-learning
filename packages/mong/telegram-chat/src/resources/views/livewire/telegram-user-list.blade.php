<div class="card bg-dark text-white h-100 border-dark">
    <div class="card-header border-bottom border-secondary bg-dark p-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" class="text-primary">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                </svg>
                <h2 class="h5 fw-bold mb-0">Telegram Users</h2>
            </div>
            <div class="position-relative w-50">
                <span class="position-absolute top-50 start-0 translate-middle-y ps-3">
                    <svg class="text-secondary" width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
                <input type="text" wire:model.live.debounce="search"
                    class="form-control bg-dark text-white border-secondary ps-5"
                    placeholder="Search by name or username...">
                @if (!empty($search))
                    <button wire:click="clearSearch"
                        class="position-absolute top-50 end-0 translate-middle-y btn btn-link text-secondary me-2 p-0"
                        style="line-height: 1;">
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                @endif
            </div>
        </div>
    </div>

    <div class="card-body p-0 overflow-auto" style="height: calc(100vh - 150px);">
        <ul class="list-group list-group-flush">
            @forelse ($users as $user)
                <li wire:key="{{ $user->id }}" wire:click="selectUser({{ $user->id }})"
                    class="list-group-item list-group-item-action bg-dark border-secondary p-3 user-item {{ $selectedUserId === $user->id ? 'active' : '' }}">
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm bg-primary text-white fw-semibold"
                                style="width: 48px; height: 48px; font-size: 1.2rem;">
                                {{ strtoupper(substr($user->first_name, 0, 1)) }}
                            </div>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="mb-0 fw-semibold text-truncate text-white">
                                    {{ $user->first_name }} {{ $user->last_name }}
                                </p>
                                @if ($user->last_message_time)
                                    <small class="text-secondary text-nowrap ms-2" style="font-size: 0.75rem;">
                                        {{ $user->last_message_time->diffForHumans(null, true) }} ago
                                    </small>
                                @endif
                            </div>
                            <p class="mb-1 text-primary small text-truncate">
                                {{ '@' . $user->username }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                @if ($user->last_message_preview)
                                    <div class="d-flex align-items-center text-secondary small text-truncate me-2">
                                        @if (!$user->last_message_is_read && !$user->lastMessage?->from_admin)
                                            <!-- Optionally show unread indicator instead of check -->
                                            <!-- <span class="me-1" style="width: 8px; height: 8px; background-color: var(--bs-primary); border-radius: 50%;"></span> -->
                                        @elseif($user->lastMessage?->from_admin)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                class="bi bi-arrow-return-right me-1" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5z" />
                                            </svg>
                                        @endif
                                        <span class="text-truncate">{{ $user->last_message_preview }}</span>
                                    </div>
                                @else
                                    <div class="small text-secondary">&nbsp;</div> <!-- Placeholder for alignment -->
                                @endif

                                @if ($user->unread_count > 0)
                                    <span class="badge bg-primary rounded-pill flex-shrink-0">
                                        {{ $user->unread_count }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </li>
            @empty
                <li class="list-group-item bg-dark text-center border-secondary py-5">
                    <div class="d-flex flex-column align-items-center text-secondary">
                        @if (!empty($search))
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" class="text-secondary mb-3">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <p class="mb-2">No users found matching "{{ $search }}"</p>
                            <button wire:click="clearSearch" class="btn btn-link text-primary btn-sm p-0">
                                Clear search
                            </button>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" class="text-secondary mb-3">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                            </svg>
                            <p>No users found</p>
                        @endif
                    </div>
                </li>
            @endforelse
        </ul>
    </div>
</div>
