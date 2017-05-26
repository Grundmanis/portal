<template>
    <div>
        <div v-if="step == 1">
            <h3>{{ trans.step }} 1</h3>

            <div class="row">
                <div class="col-sm-3" v-for="(selected,index) in selectedCategories">
                    <div class="form-group">
                        <select title="" class="form-control" v-on:change="categoryChanged(index)" v-model="selectedCategories[index]">
                            <option value="0">- {{ trans.choose_category }} -</option>
                            <option v-if="!index && !category.parents.length || index && !category.parents" :value="category" v-for="category in categories[index]">{{ category.name }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-3" v-if="categoriesSelected">
                    <div class="form-group">
                        <button v-on:click="getCategoryFilters()" class="btn btn-success">{{ trans.continue }}</button>
                    </div>
                </div>

            </div>
        </div>
        <div v-if="step == 2">
            <h3>{{ trans.step }} 2</h3>
            <form enctype="multipart/form-data" method="post">
                <input type="hidden" v-model="token" name="_token">
                <input type="hidden" v-model="category_id" name="category_id">
                <input type="hidden" v-model="category_parent_id" name="category_parent_id">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="text">{{ trans.text }}</label>
                            <textarea style="resize: none" class="form-control" id="text" cols="30" rows="10" name="text"></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <Filters v-bind:filter="filter" v-for="filter in filters[0]"></Filters>
                    </div>
                    <div class="col-sm-6">
                        <Filters v-bind:filter="filter" v-for="filter in filters[1]"></Filters>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="images">{{ trans.images }}</label>
                            <input class="form-control" type="file" multiple id="images" name="images[]">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">{{ trans.add }}</button>
            </form>
        </div>

    </div>
</template>

<script>

    import Filters from './Filters.vue';

    export default {
        props: [
            'category_list',
            'translations'
        ],
        data() {
            return {
                token: window.Laravel.csrfToken,
                categories: [JSON.parse(this.category_list)],
                selectedCategories: [0],
                categoriesSelected: false,
                step: 1,
                category_id: 0,
                category_parent_id: 0,
                filters: {},
                trans: JSON.parse(this.translations)
            }
        },
        components: { Filters },
        methods: {
            categoryChanged(index) {
                let nextIndex = index+1,
                    child = this.selectedCategories[index].child;

                // If it's not the last category
                if (child && child.length) {
                    // not selected yet
                    this.selectedCategories[nextIndex] = 0;

                    // correct categories for select
                    this.categories[nextIndex] = this.selectedCategories[index].child;

                    // delete next arrays if exist
                    this.categories.splice(nextIndex+1);

                } else {
                    // show continue button
                    this.categoriesSelected = true;
                }
            },
            getCategoryFilters() {

                let index = this.selectedCategories.length - 1,
                    category = this.selectedCategories[index].slug,
                    parentCategory = this.selectedCategories[index-1].slug;

                this.category_id = this.selectedCategories[index].id;
                this.category_parent_id = this.selectedCategories[index-1].id;

                this.$http.get('/filter/' + parentCategory + '/' + category + '/').then(function(response) {
                    if (response.ok) {
                        this.filters = response.data.filters;
                        this.step++;
                        console.log(this.filters);
                    } else {
                        console.error('something went wrong', response);
                    }
                });
            }
        }
    }
</script>
