<template>
    <div class="form-group">
        <div v-if="filter.type == 'textarea'">
            <label :for="filter.key">{{ filter.name }}</label>
            <textarea style="resize: none" class="form-control" :id="filter.key" cols="30" rows="10" :name="filter.id"></textarea>
        </div>
        <div v-if="filter.type == 'input'">
            <div class="form-group">
                <label :for="filter.key">{{ filter.name }}</label>
                <input class="form-control" type="text" :id="filter.key" :name="filter.id">
            </div>
        </div>
        <div v-if="filter.type == 'images'">
            <div class="form-group">
                <label :for="filter.key">{{ filter.name }}</label>
                <input class="form-control" type="file" multiple :id="filter.key" name="images[]">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['filter']
    }
</script>
