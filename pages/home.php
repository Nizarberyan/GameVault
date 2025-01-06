<?php
include_once("./../pages/header.php");
?>
<?php if (isset($_GET['error'])): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error: </strong>
        <span class="block sm:inline"><?= htmlspecialchars($_GET['error']); ?></span>
        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none';">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title></title>
                <path d="M14.348 5.652a1 1 0 011.415 0l.086.086a1 1 0 010 1.415L11.415 11l4.434 4.434a1 1 0 01-1.415 1.415L10 12.415l-4.434 4.434a1 1 0 01-1.415-1.415L8.585 11 4.152 6.566a1 1 0 011.415-1.415L10 9.585l4.348-4.348z" />
            </svg>
        </button>
    </div>
<?php endif; ?>

<main class="container mx-auto px-6 py-10">

    <section>
        <h2 class="text-3xl font-semibold text-[var(--text)] mb-6 w-full border-b-2 p-2 text-center">Browse Games by Category</h2>

        <div class="mb-8">
            <h3 class="text-2xl font-semibold text-[var(--text)] mb-4">Action</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class='bg-[var(--secondary)] p-4 rounded shadow h-[500px] flex flex-col justify-between'>
                    <div>
                        <img src='./../assests/6777bace44d11.jpg' alt='' class='w-full h-40 object-cover rounded mb-4'>
                        <h3 class='text-lg font-bold mb-2'>Tataros</h3>
                        <p class='text-sm mb-4 line-clamp-3'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, sapiente.</p>
                        <div class='text-sm'>
                            <p class='text-[var(--accent)]'>Price: free</p>
                            <p>Release Date: 2001-01-01</p>
                            <p>Developer: ana</p>
                            <p>Publisher: ana ausi</p>
                        </div>
                    </div>
                    <form action='' method='POST'>
                        <input type='hidden' name='game_title' value=''>
                        <button type='submit' class='w-full px-4 py-2 bg-[var(--primary)] text-white rounded hover:bg-[var(--accent)]'>Add to Library</button>
                    </form>
                </div>

                <div class='bg-[var(--secondary)] p-4 rounded shadow h-[500px] flex flex-col justify-between'>
                    <div>
                        <img src='./../assests/6777bace44d11.jpg' alt='' class='w-full h-40 object-cover rounded mb-4'>
                        <h3 class='text-lg font-bold mb-2'>Tataros</h3>
                        <p class='text-sm mb-4 line-clamp-3'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, sapiente.</p>
                        <div class='text-sm'>
                            <p class='text-[var(--accent)]'>Price: free</p>
                            <p>Release Date: 2001-01-01</p>
                            <p>Developer: ana</p>
                            <p>Publisher: ana ausi</p>
                        </div>
                    </div>
                    <form action='' method='POST'>
                        <input type='hidden' name='game_title' value=''>
                        <button type='submit' class='w-full px-4 py-2 bg-[var(--primary)] text-white rounded hover:bg-[var(--accent)]'>Add to Library</button>
                    </form>
                </div>

                <div class='bg-[var(--secondary)] p-4 rounded shadow h-[500px] flex flex-col justify-between'>
                    <div>
                        <img src='./../assests/6777bace44d11.jpg' alt='' class='w-full h-40 object-cover rounded mb-4'>
                        <h3 class='text-lg font-bold mb-2'>Tataros</h3>
                        <p class='text-sm mb-4 line-clamp-3'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, sapiente.</p>
                        <div class='text-sm'>
                            <p class='text-[var(--accent)]'>Price: free</p>
                            <p>Release Date: 2001-01-01</p>
                            <p>Developer: ana</p>
                            <p>Publisher: ana ausi</p>
                        </div>
                    </div>
                    <form action='' method='POST'>
                        <input type='hidden' name='game_title' value=''>
                        <button type='submit' class='w-full px-4 py-2 bg-[var(--primary)] text-white rounded hover:bg-[var(--accent)]'>Add to Library</button>
                    </form>
                </div>

                <div class='bg-[var(--secondary)] p-4 rounded shadow h-[500px] flex flex-col justify-between'>
                    <div>
                        <img src='./../assests/6777bace44d11.jpg' alt='' class='w-full h-40 object-cover rounded mb-4'>
                        <h3 class='text-lg font-bold mb-2'>Tataros</h3>
                        <p class='text-sm mb-4 line-clamp-3'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, sapiente.</p>
                        <div class='text-sm'>
                            <p class='text-[var(--accent)]'>Price: free</p>
                            <p>Release Date: 2001-01-01</p>
                            <p>Developer: ana</p>
                            <p>Publisher: ana ausi</p>
                        </div>
                    </div>
                    <form action='' method='POST'>
                        <input type='hidden' name='game_title' value=''>
                        <button type='submit' class='w-full px-4 py-2 bg-[var(--primary)] text-white rounded hover:bg-[var(--accent)]'>Add to Library</button>
                    </form>
                </div>
            </div>
        </div>

        <div>
            <h3 class="text-2xl font-semibold text-[var(--text)] mb-4">Adventure</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class='bg-[var(--secondary)] p-4 rounded shadow h-[500px] flex flex-col justify-between'>
                    <div>
                        <img src='./../assests/6777bace44d11.jpg' alt='' class='w-full h-40 object-cover rounded mb-4'>
                        <h3 class='text-lg font-bold mb-2'>Tataros</h3>
                        <p class='text-sm mb-4 line-clamp-3'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, sapiente.</p>
                        <div class='text-sm'>
                            <p class='text-[var(--accent)]'>Price: free</p>
                            <p>Release Date: 2001-01-01</p>
                            <p>Developer: ana</p>
                            <p>Publisher: ana ausi</p>
                        </div>
                    </div>
                    <form action='' method='POST'>
                        <input type='hidden' name='game_title' value=''>
                        <button type='submit' class='w-full px-4 py-2 bg-[var(--primary)] text-white rounded hover:bg-[var(--accent)]'>Add to Library</button>
                    </form>
                </div>

                <div class='bg-[var(--secondary)] p-4 rounded shadow h-[500px] flex flex-col justify-between'>
                    <div>
                        <img src='./../assests/6777bace44d11.jpg' alt='' class='w-full h-40 object-cover rounded mb-4'>
                        <h3 class='text-lg font-bold mb-2'>Tataros</h3>
                        <p class='text-sm mb-4 line-clamp-3'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, sapiente.</p>
                        <div class='text-sm'>
                            <p class='text-[var(--accent)]'>Price: free</p>
                            <p>Release Date: 2001-01-01</p>
                            <p>Developer: ana</p>
                            <p>Publisher: ana ausi</p>
                        </div>
                    </div>
                    <form action='' method='POST'>
                        <input type='hidden' name='game_title' value=''>
                        <button type='submit' class='w-full px-4 py-2 bg-[var(--primary)] text-white rounded hover:bg-[var(--accent)]'>Add to Library</button>
                    </form>
                </div>

                <div class='bg-[var(--secondary)] p-4 rounded shadow h-[500px] flex flex-col justify-between'>
                    <div>
                        <img src='./../assests/6777bace44d11.jpg' alt='' class='w-full h-40 object-cover rounded mb-4'>
                        <h3 class='text-lg font-bold mb-2'>Tataros</h3>
                        <p class='text-sm mb-4 line-clamp-3'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, sapiente.</p>
                        <div class='text-sm'>
                            <p class='text-[var(--accent)]'>Price: free</p>
                            <p>Release Date: 2001-01-01</p>
                            <p>Developer: ana</p>
                            <p>Publisher: ana ausi</p>
                        </div>
                    </div>
                    <form action='' method='POST'>
                        <input type='hidden' name='game_title' value=''>
                        <button type='submit' class='w-full px-4 py-2 bg-[var(--primary)] text-white rounded hover:bg-[var(--accent)]'>Add to Library</button>
                    </form>
                </div>

                <div class='bg-[var(--secondary)] p-4 rounded shadow h-[500px] flex flex-col justify-between'>
                    <div>
                        <img src='./../assests/6777bace44d11.jpg' alt='' class='w-full h-40 object-cover rounded mb-4'>
                        <h3 class='text-lg font-bold mb-2'>Tataros</h3>
                        <p class='text-sm mb-4 line-clamp-3'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, sapiente.</p>
                        <div class='text-sm'>
                            <p class='text-[var(--accent)]'>Price: free</p>
                            <p>Release Date: 2001-01-01</p>
                            <p>Developer: ana</p>
                            <p>Publisher: ana ausi</p>
                        </div>
                    </div>
                    <form action='' method='POST'>
                        <input type='hidden' name='game_title' value=''>
                        <button type='submit' class='w-full px-4 py-2 bg-[var(--primary)] text-white rounded hover:bg-[var(--accent)]'>Add to Library</button>
                    </form>
                </div>
            </div>
        </div>
    </section>



</main>

<?php
include_once("./../pages/footer.php");
?>