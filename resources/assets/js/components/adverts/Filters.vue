<template>
    <div class="form-group">
        <div v-if="filter.type == 'select'">
            <label :for="filter.key">{{ filter.name }}</label>
            <select class="form-control" :id="filter.key" :name="filter.id">
                <option :value="value" v-for="value in filter.value">{{value}}</option>
            </select>
        </div>
        <div v-if="filter.type == 'input'">
            <div class="form-group">
                <label :for="filter.key">{{ filter.name }}</label>
                <input class="form-control" type="text" :id="filter.key" :name="'filters['+filter.id+']'">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['filter']
    }
</script>
