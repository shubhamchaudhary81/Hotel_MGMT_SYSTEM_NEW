<!-- BACKDROP -->
<div 
    x-show="showCreate || showEdit || showView"
    x-transition.opacity
    x-cloak
    class="modal-backdrop"
    @keydown.escape="closeAll()"
></div>

<!-- VIEW MODAL -->
<div 
    x-show="showView"
    x-transition
    x-cloak
    :class="showView ? 'modal-box show' : 'modal-box'"
>
    <h2 class="text-xl font-semibold mb-4">Room Type Details</h2>

    <p><strong>Name:</strong> <span x-text="viewData.name"></span></p>
    <p class="mt-2"><strong>Description:</strong> <span x-text="viewData.description"></span></p>

    <div class="flex justify-end mt-6">
        <button class="btn btn-outline" @click="closeAll()">Close</button>
    </div>
</div>


<!-- EDIT MODAL -->
<div 
    x-show="showEdit"
    x-transition
    x-cloak
    :class="showEdit ? 'modal-box show' : 'modal-box'"
>
    <h2 class="text-xl font-semibold mb-4">Edit Room Type</h2>

    <form :action="`/admin/room-types/${editData.id}`" method="POST">
        @csrf
        @method('PUT')

        <input class="modal-input" type="text" name="name" x-model="editData.name">

        <textarea class="modal-input" name="description" rows="4" x-model="editData.description"></textarea>

        <div class="flex justify-end gap-2">
            <button type="button" class="btn btn-outline" @click="closeAll()">Cancel</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>


<!-- CREATE MODAL -->
<div 
    x-show="showCreate"
    x-transition
    x-cloak
    :class="showCreate ? 'modal-box show' : 'modal-box'"
>
    <h2 class="text-xl font-semibold mb-4">Add Room Type</h2>

    <form action="{{ route('admin.room-types.store') }}" method="POST">
        @csrf

        <input class="modal-input" type="text" name="name" placeholder="Room Type Name">

        <textarea class="modal-input" name="description" rows="4" placeholder="Description"></textarea>

        <div class="flex justify-end gap-2">
            <button type="button" class="btn btn-outline" @click="closeAll()">Cancel</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
