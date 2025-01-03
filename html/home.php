<?php
include_once("./../html/header.php");
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

    <section class="mb-12">
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Featured Games</h2>
        <div class="relative">
            <div class="overflow-hidden">
                <div class="flex transition-transform duration-500 ease-in-out justify-center items-center gap-2 p-2 w-full" id="slider">

                    <div class="flex w-4/5 md:w-1/3 lg:w-1/3 xl:w-1/3 mx-auto rounded-lg shadow-xl bg-white h-100">
                        <img src="https://previews.123rf.com/images/sqback/sqback1610/sqback161000003/63641174-ghost-in-the-dark.jpg" alt="Game Image" class="w-full h-[50%] object-cover rounded-t-lg">
                        <div class="p-4 h-fit flex flex-col justify-between">
                            <h3 class="text-xl font-semibold text-gray-800">Game Title</h3>
                            <p class="text-sm text-gray-600">Game description or genrGame description or genrGame description or genrGame description or genrGame description or genre</p>
                        </div>
                    </div>

                </div>
            </div>

            <button id="prev" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-indigo-600 text-white p-2 rounded-full shadow-lg hover:bg-indigo-700">
                <span class="text-xl">&#10094;</span>
            </button>
            <button id="next" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-indigo-600 text-white p-2 rounded-full shadow-lg hover:bg-indigo-700">
                <span class="text-xl">&#10095;</span>
            </button>
        </div>
    </section>

    <section>
        <h2 class="text-3xl font-semibold text-gray-800 mb-6">Browse Games by Category</h2>

        <div class="mb-8">
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Action</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="relative rounded-lg shadow-xl bg-white">
                    <div class="relative w-full pb-[80%]"> <!-- Aspect ratio 4:9 -->
                        <img src="https://via.placeholder.com/400x300" alt="Action Game 1" class="absolute inset-0 w-full h-full object-cover rounded-t-lg">
                    </div>
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800">Action Game 1</h3>
                        <p class="text-sm text-gray-600">High-paced combat game</p>
                    </div>
                </div>

                <div class="relative rounded-lg shadow-xl bg-white">
                    <div class="relative w-full pb-[80%]"> <!-- Aspect ratio 4:9 -->
                        <img src="https://via.placeholder.com/400x300" alt="Action Game 2" class="absolute inset-0 w-full h-full object-cover rounded-t-lg">
                    </div>
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800">Action Game 2</h3>
                        <p class="text-sm text-gray-600">Fast action with dynamic environments</p>
                    </div>
                </div>

                <div class="relative rounded-lg shadow-xl bg-white">
                    <div class="relative w-full pb-[80%]"> <!-- Aspect ratio 4:9 -->
                        <img src="https://via.placeholder.com/400x300" alt="Action Game 3" class="absolute inset-0 w-full h-full object-cover rounded-t-lg">
                    </div>
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800">Action Game 3</h3>
                        <p class="text-sm text-gray-600">Survival and strategy gameplay</p>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Adventure</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="relative rounded-lg shadow-xl bg-white">
                    <div class="relative w-full pb-[80%]"> <!-- Aspect ratio 4:9 -->
                        <img src="https://via.placeholder.com/400x300" alt="Adventure Game 1" class="absolute inset-0 w-full h-full object-cover rounded-t-lg">
                    </div>
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800">Adventure Game 1</h3>
                        <p class="text-sm text-gray-600">Explore vast worlds and solve puzzles</p>
                    </div>
                </div>

                <div class="relative rounded-lg shadow-xl bg-white">
                    <div class="relative w-full pb-[80%]"> <!-- Aspect ratio 4:9 -->
                        <img src="https://via.placeholder.com/400x300" alt="Adventure Game 2" class="absolute inset-0 w-full h-full object-cover rounded-t-lg">
                    </div>
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800">Adventure Game 2</h3>
                        <p class="text-sm text-gray-600">Fantasy exploration and story-driven</p>
                    </div>
                </div>

                <div class="relative rounded-lg shadow-xl bg-white">
                    <div class="relative w-full pb-[80%]"> <!-- Aspect ratio 4:9 -->
                        <img src="https://via.placeholder.com/400x300" alt="Adventure Game 3" class="absolute inset-0 w-full h-full object-cover rounded-t-lg">
                    </div>
                    <div class="p-4">
                        <h3 class="text-xl font-semibold text-gray-800">Adventure Game 3</h3>
                        <p class="text-sm text-gray-600">Adventurous exploration with combat</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



</main>

<?php
include_once("./../html/footer.php");
?>