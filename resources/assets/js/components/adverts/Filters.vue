<template>
    <div class="form-group">
        <div v-if="filter.type == 'textarea'">
            <label :for="filter.name">{{ filter.name }}</label>
            <textarea style="resize: none" class="form-control" :name="filter.name" :id="filter.name" cols="30" rows="10"></textarea>
        </div>
        <div v-if="filter.type == 'input'">
            <div class="form-group">
                <label :for="filter.name">{{ filter.name }}</label>
                <input class="form-control" type="text" :id="filter.name" :name="filter.name">
            </div>
        </div>
        <div v-if="filter.type == 'images'">
            <div class="form-group">
                <label :for="filter.name">{{ filter.name }}</label>
                <input class="form-control" type="file" multiple :id="filter.name" :name="filter.name">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['filter']
    }
</script>
