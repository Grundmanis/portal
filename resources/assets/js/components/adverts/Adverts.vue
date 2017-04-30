<template>
    <div>
        <div class="filters">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Filters</h3>
                </div>
                <form :action="currentLocation">
                    <div class="panel-body">
                            <div class="form-inline">
                                <div class="form-group" v-for="filter in category.filters">
                                    <p>
                                        <label :for="filter.name">{{ filter.name }}</label>
                                    </p>
                                    <select v-if="filter.type == 'select'" class="form-control" :name="filter.name" :id="filter.name">
                                        <option :selected="get[filter.name] == value ? true : false" v-for="value in JSON.parse(filter.value)">
                                            {{ value }}
                                        </option>
                                    </select>
                                    <input v-if="filter.type == 'input'" class="form-control" :placeholder="filter.value" v-model="get[filter.name]" :name="filter.name" :id="filter.name" type="text">
                                </div>
                            </div>
                    </div>
                    <div class="panel-footer text-right">
                        <input type="submit" value="Search" class="btn btn-primary">
                        <input type="button" value="Clear" class="btn btn-sm btn-danger">
                    </div>
                </form>
            </div>
            <div class="form-inline text-right">
                <div class="form-group text-left">
                    <p>
                        <label for="show">Show</label>
                    </p>
                    <select class="form-control" id="show" v-model="showAs">
                        <option value="table">Table</option>
                        <option value="grid">Grid</option>
                    </select>
                </div>

                <div class="form-group text-left">
                    <p>
                        <label for="per_page">Per page</label>
                    </p>
                    <select class="form-control" id="per_page" v-model="perPage" v-on:change="changePerPage">
                        <option>2</option>
                        <option>4</option>
                        <option>6</option>
                    </select>
                </div>
            </div>
        </div>

        <table v-if="showAs == 'table'" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="1">id</th>
                    <th>text</th>
                    <th v-if="filter.main" v-for="filter in category.filters">
                        {{ filter.name }}
                    </th>
                    <th width="1">created</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="advert in adverts.data">
                    <td>{{ advert.id }}</td>
                    <td>
                        <a :href="advert.id">
                            {{ advert.text }}
                        </a>
                    </td>
                    <th v-if="filter.main" v-for="filter in category.filters">
                         {{ advert.idFilters[filter.id] ? advert.idFilters[filter.id].value : '' }}
                    </th>
                    <td>{{ advert.created_at }}</td>
                </tr>
            </tbody>
        </table>

        <div class="row" v-if="showAs == 'grid'">
            <div class="col-sm-6 col-md-4" v-for="advert in adverts.data">
                <div class="thumbnail">
                    <div class="caption">
                        <p>
                            <a href="">
                                {{ advert.text }}
                            </a>
                        </p>
                        <p><a href="#" class="btn btn-primary" role="button">Open</a></p>
                    </div>
                </div>
            </div>
        </div>

        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li v-bind:class="{disabled: adverts.current_page == 1}">
                    <a v-if="adverts.current_page != 1" v-on:click.prevent="prevPage" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    <span v-if="adverts.current_page == 1" aria-hidden="true">&laquo;</span>
                </li>
                <li v-bind:class="{active: page == adverts.current_page}" v-for="page in totalPages">
                    <a v-on:click.prevent="jumpToPage(page)" v-if="page != adverts.current_page" href="#">{{ page }}</a>
                    <span v-if="page == adverts.current_page">{{ page }}</span>
                </li>
                <li v-bind:class="{disabled: adverts.current_page == adverts.last_page}">
                    <a v-if="adverts.current_page != adverts.last_page" v-on:click.prevent="nextPage" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    <span v-if="adverts.current_page == adverts.last_page" aria-hidden="true">&raquo;</span>
                </li>
            </ul>
        </nav>

    </div>
</template>

<script>
    export default {
        props: [
            'advert_list',
            'category_list',
            'subcategory_list',
            'get_params'
        ],
        data() {
            return {
                adverts: JSON.parse(this.advert_list),
                category: JSON.parse(this.category_list),
                subcategory: JSON.parse(this.subcategory_list),
                totalPages: 1,
                perPage: 2,
                showAs: 'table',
                currentLocation: location.protocol + '//' + location.host + location.pathname,
                get: JSON.parse(this.get_params)
            }
        },
        mounted() {
            this.totalPages = Math.ceil(this.adverts.total / this.adverts.per_page);
        },
        watch: {
            adverts: function () {
                this.totalPages = Math.ceil(this.adverts.total / this.adverts.per_page);
            }
        },
        methods: {
            nextPage() {
                this.$http.get(this.adverts.next_page_url+'&per_page='+this.perPage).then(function(response) {
                    this.adverts = response.data.adverts;
                });
            },
            prevPage() {
                this.$http.get(this.adverts.prev_page_url+'&per_page='+this.perPage).then(function(response) {
                    this.adverts = response.data.adverts;
                });
            },
            jumpToPage(page) {
                this.$http.get(this.currentLocation + '?page='+page+'&per_page='+this.perPage).then(function(response) {
                    this.adverts = response.data.adverts;
                });
            },
            changePerPage() {
                this.$http.get(this.currentLocation + '?page='+1+'&per_page='+this.perPage).then(function(response) {
                    this.adverts = response.data.adverts;
                });
            }
        }
    }
</script>
