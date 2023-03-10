<div class="contacts_body">
    <ul class="contacts">
        @foreach($users as $user)
        @php
            $active =   request()->is('message-box/'.$user->id) ? 'active' : '';
        @endphp
            <a href="{{ route('messageBox',['id'=>$user->id])}}">
                <li class="{{$active}}" >
                    <div class="d-flex bd-highlight">
                        <div class="img_cont">
                            <img src="{{ $user->getImagePath() }}"
                                class="rounded-circle user_img">
                            @if($user->online_status == 'online')
                                <span class="online_icon"></span>
                            @endif
                        </div>
                        <div class="user_info">
                            <span>{{ucFirst($user->name)}}</span>
                            @if($user->online_status == 'online')
                                <p>{{ucFirst($user->name)}} is online</p>
                            @endif
                        </div>
                    </div>
                </li>
            </a>
        @endforeach
        {{-- <li>
            <div class="d-flex bd-highlight">
                <div class="img_cont">
                    <img src="https://2.bp.blogspot.com/-8ytYF7cfPkQ/WkPe1-rtrcI/AAAAAAAAGqU/FGfTDVgkcIwmOTtjLka51vineFBExJuSACLcBGAs/s320/31.jpg"
                        class="rounded-circle user_img">
                    <span class="online_icon offline"></span>
                </div>
                <div class="user_info">
                    <span>Taherah Big</span>
                    <p>Taherah left 7 mins ago</p>
                </div>
            </div>
        </li> --}}
        {{-- <li>
            <div class="d-flex bd-highlight">
                <div class="img_cont">
                    <img src="https://i.pinimg.com/originals/ac/b9/90/acb990190ca1ddbb9b20db303375bb58.jpg"
                        class="rounded-circle user_img">
                    <span class="online_icon"></span>
                </div>
                <div class="user_info">
                    <span>Sami Rafi</span>
                    <p>Sami is online</p>
                </div>
            </div>
        </li>
        <li>
            <div class="d-flex bd-highlight">
                <div class="img_cont">
                    <img src="http://profilepicturesdp.com/wp-content/uploads/2018/07/sweet-girl-profile-pictures-9.jpg"
                        class="rounded-circle user_img">
                    <span class="online_icon offline"></span>
                </div>
                <div class="user_info">
                    <span>Nargis Hawa</span>
                    <p>Nargis left 30 mins ago</p>
                </div>
            </div>
        </li>
        <li>
            <div class="d-flex bd-highlight">
                <div class="img_cont">
                    <img src="https://static.turbosquid.com/Preview/001214/650/2V/boy-cartoon-3D-model_D.jpg"
                        class="rounded-circle user_img">
                    <span class="online_icon offline"></span>
                </div>
                <div class="user_info">
                    <span>Rashid Samim</span>
                    <p>Rashid left 50 mins ago</p>
                </div>
            </div>
        </li> --}}
    </ul>
</div>