
<!-- Modal HTML -->
<div class="overlay-modal-delete hidden fixed w-full h-full bg-black/70 backdrop-blur-sm place-content-center top-0 left-0 z-20">
    <div id="modal-confirm-delete" class="w-[80vw] max-w-[30rem] opacity-0 p-6 rounded-lg bg-white text-center shadow-md translate-y-[10rem] duration-700 ease-in-out z-40">
        <div class="content-wrapper relative h-full flex flex-col gap-4 justify-between items-center font-medium text-primary">
            <button class="close-modal-btn absolute -top-1 -right-1 text-xl text-secondary-300 hover:text-primary-600">
                <iconify-icon icon="rivet-icons:close"></iconify-icon>
            </button>
            <div class="text-wrapper flex flex-col gap-4">
                <h2 class="text-primary-600 text-medium">Pemberitahuan!</h2>
                <h1 class="text-2xl font-semibold">Apakah Anda yakin ingin<span class="text-red-500 font-semibold"> menghapus</span> ulasan ini?</h1>
                <p class="text-sm font-light text-slate-500">Ketika Anda menghapus ulasan ini, data tersebut akan hilang secara permanen.</p>
            </div>
            <div class="button-wrapper flex gap-2 text-xs font-normal text-primary">
                <button id="cancelDeleteBtn" class="py-3 px-6 rounded-md text-primary bg-slate-100 hover:bg-slate-200 hover:border-slate-200 active:bg-slate-100 duration-150">Batalkan</button>
                <form id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="py-3 px-6 rounded-md bg-red-300 hover:bg-red-500 active:bg-red-300 text-white duration-150">Ya, Hapus</button>
                </form>   
            </div>
        </div>
    </div>
</div>