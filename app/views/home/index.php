<section class="max-w-5xl my-12 mx-auto">
    <?php Flasher::flash() ?>

    <div class="flex items-center mb-4 gap-2 ">
        <form method="GET" action="<?= BASEURL ?>" class="flex gap-2 flex-1">
            <input type="text" name="search" placeholder="Search students..."  value="<?= htmlspecialchars($data['search'] ?? '') ?>" class="border border-gray-200 rounded px-3 py-2 w-full">
            <button type="submit" class="font-medium bg-gray-800 text-white px-4 py-2 rounded">Search</button>
        </form>
        <button data-modal-target="modal-create" data-modal-toggle="modal-create" class="font-medium px-4 py-2 rounded bg-blue-600 text-white ">Create Data</button>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-white uppercase bg-gray-800">
            <tr>
                <th scope="col" class="px-6 py-3">No</th>
                <th scope="col" class="px-6 py-3">
                    <a href="<?= BASEURL ?>1/name/<?= ($data['sortBy'] == 'name' && $data['sortOrder'] == 'ASC') ? 'DESC' : 'ASC' ?>"
                       class="hover:underline flex gap-1 items-center">
                        Name
                        <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                        </svg>
                    </a>
                </th>
                <th scope="col" class="px-6 py-3">
                    <a href="<?= BASEURL ?>1/nisn/<?= ($data['sortBy'] == 'nisn' && $data['sortOrder'] == 'ASC') ? 'DESC' : 'ASC' ?>"
                       class="hover:underline flex gap-1 items-center">
                        NISN
                        <svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                        </svg
                    </a>
                </th>
                <th scope="col" class="px-6 py-3">Address</th>
                <th scope="col" class="px-6 py-3">Age</th>
                <th scope="col" class="px-6 py-3"><span class="sr-only">Edit</span></th>
            </tr>
            </thead>
            <tbody>
            <?php $num = ($data['currentPage'] - 1) * 10 + 1; ?>
            <?php foreach ($data['students'] as $student) : ?>
                <tr class="bg-white border-b border-gray-200 even:bg-gray-50">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"><?= $num ?></th>
                    <td class="px-6 py-4"><?= $student['name'] ?></td>
                    <td class="px-6 py-4"><?= $student['nisn'] ?></td>
                    <td class="px-6 py-4"><?= $student['address'] ?></td>
                    <td class="px-6 py-4"><?= $student['age'] ?></td>
                    <td class="px-6 py-4 flex gap-4">
                        <button data-modal-target="modal-<?= $student['nisn'] ?>" data-modal-toggle="modal-<?= $student['nisn'] ?>" class="font-medium text-blue-600 hover:underline">Edit</button>
                        <a href="<?= BASEURL ?>/students/delete/<?= $student['id'] ?>" class="font-medium text-red-400 hover:underline">Delete</a>
                    </td>
                </tr>

                <!-- Modal for each student -->
                <div id="modal-<?= $student['nisn'] ?>" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50">
                    <div class="bg-white rounded-lg shadow-lg w-[26rem]">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 border-b">
                            <h3 class="text-lg font-semibold">Edit Student</h3>
                            <button type="button" class="text-gray-400 hover:text-gray-900" data-modal-hide="modal-<?= $student['nisn'] ?>">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4">
                            <form action="<?= BASEURL?>/students/update" method="POST">
                                <div class="mb-4">
                                    <label for="name-<?= $student['nisn'] ?>" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                                    <input type="text" name="name" id="name-<?= $student['nisn'] ?>" value="<?= $student['name'] ?>" class="w-full p-2 border text-sm text-gray-600 rounded-lg">
                                </div>
                                <div class="mb-4">
                                    <label for="nisn-<?= $student['nisn'] ?>" class="block text-sm font-medium text-gray-700 mb-2">NISN</label>
                                    <input type="text"  name="nisn" id="name-<?= $student['nisn'] ?>" value="<?= $student['nisn'] ?>" class="w-full p-2 bg-gray-200 border text-sm text-gray-400 rounded-lg" disabled
                                </div>
                                <div class="my-4">
                                    <label for="address-<?= $student['nisn'] ?>" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                                    <input type="text" name="address" id="address-<?= $student['nisn'] ?>" value="<?= $student['address'] ?>" class="w-full p-2 border text-sm text-gray-600 rounded-lg">
                                </div>
                                <div class="mb-4">
                                    <label for="age-<?= $student['nisn'] ?>" class="block text-sm font-medium text-gray-700 mb-2">Age</label>
                                    <input type="text" name="age" id="age-<?= $student['nisn'] ?>" value="<?= $student['age'] ?>" class="w-full p-2 border text-sm text-gray-600 rounded-lg">
                                </div>
                                <input type="hidden" name="id" id="id-<?= $student['nisn'] ?>" value="<?= $student['id'] ?>" class="w-full p-2 border text-sm text-gray-600 rounded-lg">
                                <button type="submit" class="w-full bg-blue-600 text-white py-2 mt-6 rounded-lg hover:bg-blue-700">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php $num++; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-end my-6 mx-6">
        <nav class="flex space-x-2">
            <?php for ($i = 1; $i <= $data['totalPages']; $i++) : ?>
                <a href="<?= BASEURL ?><?= $i ?>/<?= $data['sortBy'] ?>/<?= $data['sortOrder'] ?>"
                   class="px-4 py-1 rounded-lg text-lg
                   <?= ($i == $data['currentPage']) ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-600 hover:bg-gray-300 ' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </nav>
    </div>

    <!-- Create Form -->
    <div id="modal-create" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-900 bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-[26rem]">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-lg font-semibold">Edit Student</h3>
                <button type="button" class="text-gray-400 hover:text-gray-900" data-modal-hide="modal-create">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4">
                <form action="<?= BASEURL?>/students/store" method="POST">
                    <div class="mb-4">
                        <label for="name-create" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input type="text" name="name" id="name-create"  class="w-full p-2 border text-sm text-gray-600 rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label for="nisn-create" class="block text-sm font-medium text-gray-700 mb-2">NISN</label>
                        <input type="text" name="nisn" id="nisn-create"  class="w-full p-2 border text-sm text-gray-600 rounded-lg">
                    </div>
                    <div class="my-4">
                        <label for="address-create" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <input type="text" name="address" id="address-create"  class="w-full p-2 border text-sm text-gray-600 rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label for="age-create" class="block text-sm font-medium text-gray-700 mb-2">Age</label>
                        <input type="text" name="age" id="age-create"  class="w-full p-2 border text-sm text-gray-600 rounded-lg">
                    </div>
                    <input type="hidden" name="id" id="id-create" class="w-full p-2 border text-sm text-gray-600 rounded-lg">
                    <button type="submit" class="w-full bg-blue-600 text-white py-2 mt-6 rounded-lg hover:bg-blue-700">Save</button>
                </form>
            </div>
        </div>
    </div>

</section>
