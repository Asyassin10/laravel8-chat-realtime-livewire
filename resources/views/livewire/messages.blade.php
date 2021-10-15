<div>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-4 ">
                <div class="card">
                    <div class="card-header">
                        Users
                    </div>
                    <div class="card-body chatbox p-0 " rel="noopener">
                        <ul class="list-group list-group-flush">
                            @foreach ($users as $user)
                                @if ($user->id !== auth()->id())
                                    @php
                                        $not_seen =
                                            App\Models\Message::where('user_id', $user->id)
                                                ->where('receiver_id', auth()->id())
                                                ->where('is_seen', false)
                                                ->get() ?? null;

                                    @endphp
                                    <a wire:click="getUser({{ $user->id }})" class="text-dark link">
                                        <li class="list-group-item">
                                            <img class="img-fluid avatar"
                                                src="{{ $user->picture }}"
                                                height="50" width="50">
                                            @if ($user->is_online == 1)

                                                <i class="fa fa-circle text-success online-icon"></i>
                                            @endif

                                            {{ $user->name }}
                                            @if (filled($not_seen))
                                                <div class="badge badge-success rounded"> {{ $not_seen->count() }}
                                                </div>
                                            @endif
                                        </li>
                                    </a>
                                @endif

                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
            <!--end col md 4-->


            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header ">

                        @if (isset($sender))<img src="{{ $sender->picture }} " alt="" height="50" width="50"> {{ $sender->name }}   @endif
                    </div>
                    <div class="col-md-11">
                        <div class="card">
                            <div class="card-body message-box " wire:poll="mountdata">
                                @if (filled($allmessages))
                                    @foreach ($allmessages as $mgs)
                                        <div class="single-message @if ($mgs->user_id == auth()->id()) text-right  badge-light @else received @endif">
                                            <p class="font-weight-bolder my-0">
                                                {{ $mgs->user->name }}

                                            </p>
                                            <p>{{ $mgs->message }}</p>

                                            <br><small class="text-muted w-100">Sent
                                                <em>
                                                    {{ $mgs->created_at }}</em></small>
                                        </div>
                                        <hr class="bg bg-primary">
                                    @endforeach
                                @endif

                            </div>


                            <div class="card-footer">

                                <form wire:submit.prevent="SendMessage">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <input wire:model="message"
                                                class="form-control input shadow-none w-100 d-inline-block"
                                                placeholder="Type a message" required>
                                        </div>

                                        <div class="col-md-4">
                                            <button type="submit"
                                                class="btn btn-primary d-inline-block w-100 text-white"><i
                                                    class="far fa-paper-plane"></i> Send</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
