<div class="card bg-dark text-white h-100 border-dark border-start">
    @if ($telegramUser)
        <!-- Chat Header -->
        <div x-data x-init="$nextTick(() => {
            const messageContainer = document.getElementById('chat-messages');
            if (messageContainer) {
                messageContainer.scrollTop = messageContainer.scrollHeight;
            }
        })"
            class="card-header bg-dark border-bottom border-secondary d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-3">
                <div>
                    <div class="rounded-circle d-flex align-items-center justify-content-center shadow bg-primary text-white" style="width: 40px; height: 40px;">
                        <span class="fw-semibold">{{ substr($telegramUser->first_name, 0, 1) }}</span>
                    </div>
                </div>
                <div>
                    <h3 class="h5 mb-0 fw-semibold text-white">
                        {{ $telegramUser->first_name }} {{ $telegramUser->last_name }}
                    </h3>
                    <p class="mb-0 small text-primary">
                        {{ '@' . $telegramUser->username }}
                    </p>
                </div>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                    </svg>
                </button>
                <button type="button" class="btn btn-sm btn-outline-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Chat Messages -->
        <div id="chat-messages" class="overflow-auto p-3 bg-dark" style="height: calc(100vh - 10rem);" 
            x-ref="messageContainer" x-init="$nextTick(() => { $refs.messageContainer.scrollTop = $refs.messageContainer.scrollHeight; })" wire:loading.class="opacity-50">
            @foreach ($messages as $message)
                <div class="d-flex {{ $message['direction'] == 'out' ? 'justify-content-end' : 'justify-content-start' }} mb-3"
                    wire:key="message-{{ $message['id'] }}">
                    @if ($message['direction'] != 'out')
                        <div class="me-2">
                            <div class="rounded-circle d-flex align-items-center justify-content-center bg-primary text-white" style="width: 32px; height: 32px;">
                                <span class="small fw-semibold">{{ substr($telegramUser->first_name, 0, 1) }}</span>
                            </div>
                        </div>
                    @endif
                    <div class="position-relative" style="max-width: 70%;">
                        <div class="p-2 px-3 rounded-3 shadow-sm {{ $message['sender'] == 'admin' ? 'bg-primary text-white' : 'bg-dark text-white border border-secondary' }}">
                            @if ($message['sender'] != 'admin')
                                <p class="small fw-medium text-primary mb-1">{{ $telegramUser->first_name }}</p>
                            @endif
                            @if (isset($message['file_type']))
                                @if (explode('/', $message['file_type'])[0] == 'image')
                                    <img src="{{ $message['file_path'] }}" alt="Image"
                                        class="rounded img-fluid mb-2" style="width: 200px; height: 200px; object-fit: cover;">
                                @elseif (explode('/', $message['file_type'])[0] == 'audio')
                                    <livewire:voice-audio :audio="$message['file_path']" />
                                @endif
                            @endif

                            <p class="small mb-1">{{ $message['message'] }}</p>
                            <div class="d-flex align-items-center justify-content-end gap-1">
                                <small class="{{ $message['direction'] == 'out' ? 'text-info' : 'text-secondary' }}">
                                    {{ $message['created_at']->format('h:i A') }}
                                </small>
                                @if ($message['direction'] == 'out')
                                    <span class="text-info">
                                        @if ($message['is_read'])
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Chat Input -->
        <div class="card-footer border-top border-secondary bg-dark">
            <form wire:submit.prevent="send" class="d-flex flex-column gap-2">
                <div class="d-flex gap-2">
                    <div class="position-relative flex-grow-1 d-flex align-items-center" wire:ignore>
                        <input type="text" wire:model="message" class="form-control bg-dark border-secondary text-white" placeholder="Type your message..." autocomplete="off">

                        <!-- Voice Recording Button -->
                        <div x-data="voiceRecorder()" x-init="init()" class="position-absolute end-0 me-2">
                            <button type="button" x-show="!recording" @click.prevent="startRecording"
                                class="btn btn-link text-secondary p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7 4a3 3 0 016 0v4a3 3 0 11-6 0V4zm4 10.93A7.001 7.001 0 0017 8a1 1 0 10-2 0A5 5 0 015 8a1 1 0 00-2 0 7.001 7.001 0 006 6.93V17H6a1 1 0 100 2h8a1 1 0 100-2h-3v-2.07z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Recording Interface -->
                            <div x-show="recording" class="d-flex align-items-center gap-2">
                                <span class="text-danger animate__animated animate__flash animate__infinite" x-text="formatDuration(duration)"></span>
                                <button type="button" @click.prevent="stopRecording" class="btn btn-link text-primary p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1V8a1 1 0 00-1-1H8z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                <button type="button" @click.prevent="cancelRecording" class="btn btn-link text-danger p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" x-bind:disabled="$wire.isRecording">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                        </svg>
                    </button>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <input type="file" wire:model="document" class="form-control form-control-sm bg-dark border-secondary text-white">
                    @if ($document)
                        <small class="text-secondary">{{ $document->getClientOriginalName() }}</small>
                        <button type="button" wire:click="$set('document', null)" class="btn btn-link text-danger p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    @endif
                </div>
            </form>
        </div>
    @else
        <div class="d-flex align-items-center justify-content-center h-100 bg-dark">
            <div class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-secondary mb-3 mx-auto">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <p class="text-secondary">Select a user to start chatting</p>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        const scrollToBottom = () => {
            const messageContainer = document.getElementById('chat-messages');
            if (messageContainer) {
                setTimeout(() => {
                    messageContainer.scrollTop = messageContainer.scrollHeight;
                }, 200);
            }
        };

        // When conversation is loaded
        Livewire.on('conversationLoaded', () => {
            scrollToBottom();
        });

        // When message is sent or received
        Livewire.on('messageSent', scrollToBottom);
        Livewire.on('messageReceived', scrollToBottom);

        // Watch for changes in the messages container
        const observer = new MutationObserver(scrollToBottom);
        const messageContainer = document.getElementById('chat-messages');
        if (messageContainer) {
            observer.observe(messageContainer, {
                childList: true,
                subtree: true
            });
        }

        // Voice Recorder Alpine Component
        Alpine.data('voiceRecorder', () => ({
            mediaRecorder: null,
            audioChunks: [],
            duration: 0,
            timer: null,
            recording: false,

            init() {
                this.recording = false;
                this.duration = 0;
            },

            async startRecording() {
                try {
                    const stream = await navigator.mediaDevices.getUserMedia({
                        audio: true
                    });

                    // Use WebM with Opus codec (widely supported)
                    const options = {
                        mimeType: 'audio/webm;codecs=opus',
                        audioBitsPerSecond: 128000
                    };

                    this.mediaRecorder = new MediaRecorder(stream, options);
                    this.audioChunks = [];

                    this.mediaRecorder.ondataavailable = (event) => {
                        this.audioChunks.push(event.data);
                    };

                    this.mediaRecorder.onstop = async () => {
                        const audioBlob = new Blob(this.audioChunks, {
                            type: 'audio/webm;codecs=opus'
                        });
                        const reader = new FileReader();
                        reader.readAsDataURL(audioBlob);
                        reader.onloadend = () => {
                            Livewire.dispatch('voiceRecordingStopped', {
                                audioData: reader.result
                            });
                        };
                        this.stopTimer();
                        stream.getTracks().forEach(track => track.stop());
                    };

                    // Request data every second to ensure we get all the audio
                    this.mediaRecorder.start(1000);
                    this.startTimer();
                    this.recording = true;
                    Livewire.dispatch('voiceRecordingStarted');
                } catch (error) {
                    console.error('Error accessing microphone:', error);
                    alert(
                        'Could not access microphone. Please check your browser permissions and make sure you are using a supported browser.'
                        );
                }
            },

            stopRecording() {
                if (this.mediaRecorder && this.mediaRecorder.state === 'recording') {
                    this.mediaRecorder.stop();
                    this.recording = false;
                }
            },

            cancelRecording() {
                if (this.mediaRecorder && this.mediaRecorder.state === 'recording') {
                    this.mediaRecorder.stop();
                    this.audioChunks = [];
                    this.stopTimer();
                    this.recording = false;
                    Livewire.dispatch('voiceRecordingCancelled');
                }
            },

            startTimer() {
                this.duration = 0;
                this.timer = setInterval(() => {
                    this.duration++;
                }, 1000);
            },

            stopTimer() {
                if (this.timer) {
                    clearInterval(this.timer);
                    this.timer = null;
                }
            },

            formatDuration(seconds) {
                const minutes = Math.floor(seconds / 60);
                const remainingSeconds = seconds % 60;
                return `${minutes}:${remainingSeconds.toString().padStart(2, '0')}`;
            }
        }));
    });
</script>

<style>
/* Custom scrollbar for the chat */
#chat-messages::-webkit-scrollbar {
    width: 6px;
}

#chat-messages::-webkit-scrollbar-track {
    background: #212529;
}

#chat-messages::-webkit-scrollbar-thumb {
    background-color: #495057;
    border-radius: 6px;
}

/* Smooth scrolling */
#chat-messages {
    scroll-behavior: smooth;
}

/* Animate the recording timer */
@keyframes flash {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}
.animate__flash {
    animation: flash 1s infinite;
}
</style>