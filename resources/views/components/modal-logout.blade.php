<div class="overlay-modal hidden w-full h-full bg-black/70 backdrop-blur-sm place-content-center absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-50">
    <div id="modal-confirm-logout" class="w-[80vw] max-w-[30rem] opacity-0 aspect-video p-6 rounded-lg bg-white text-center shadow-md translate-y-[10rem] duration-700 ease-in-out">
        <div class="content-wrapper relative h-full flex flex-col justify-between items-center font-medium text-primary">
            <button class="close-modal-btn absolute -top-1 -right-1 text-xl text-secondary-300 hover:text-primary-600">
                <iconify-icon icon="rivet-icons:close"></iconify-icon>
            </button>
            <div class="text-wrapper flex flex-col gap-4">
                <h2 class="text-primary-600 text-medium">Pemberitahuan!</h2>
                <h1 class="text-2xl font-semibold">Apakah Anda yakin ingin<br>melakukan <span class="text-red-500 font-semibold"> logout?</span></h1>
                <p class="text-sm font-light text-slate-500">Ketika Anda sudah logout, Anda <span class="text-red-400">tidak akan</span>  bisa melakukan pemesanan apapun.</p>
            </div>
            <div class="button-wrapper flex gap-2 text-xs font-normal text-primary">
                <button id="cancelLogoutBtn" class="py-3 px-6 rounded-md text-primary bg-slate-100 hover:bg-slate-200 hover:border-slate-200 active:bg-slate-100 duration-150">Batalkan</button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="py-3 px-6 rounded-md bg-red-300 hover:bg-red-500 active:bg-red-300 text-white duration-150">Ya, Saya ingin logout</button>
                </form>   
            </div>
        </div>
    </div>
</div>
