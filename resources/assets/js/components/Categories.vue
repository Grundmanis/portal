<template>
    <div>
        <div class="button-group text-center">
            <button v-for="category in cats" onclick="location.href='#'"  class="btn btn-success category-title">
                {{ category.translation.name }}
            </button>
        </div>
    </div>


    <!--@foreach($categories as $category)-->
    <!--@if (!$category->parent_id)-->
    <!--<button onclick="location.href= '{{ route('adverts') }}'" class="btn btn-{{ $category->color ? $category->color : 'danger' }} category-title">-->
        <!--{{ $category->translation->keyBy('lng')['en']->name }}-->
    <!--</button>-->
    <!--@endif-->
    <!--@endforeach-->

</template>

<script>
    export default {
        props: [
            'categories',
            'adverts_route'
        ],
        data() {
          return {
              cats: JSON.parse(this.categories)
          }
        },
        mounted() {
            console.log(this.cats);
        }
    }
</script>
