<template>
  <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
    <div class="flex-1 flex justify-between sm:hidden">
      <inertia-link v-if="current_page>1" :href="prev_page_url" :class="classes_prev">
        Previous
      </inertia-link>
      <inertia-link v-if="current_page < last_page" :href="next_page_url" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500">
        Next
      </inertia-link>
    </div>
    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          Se muestran 
          <span class="font-medium">{{from}}</span>
          a
          <span class="font-medium">{{to}}</span>
          de
          <span class="font-medium">{{total}}</span>
          resultados
        </p>
      </div>
      <div>
        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
          <inertia-link v-if="current_page>1" :href="first_page_url" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
            <span class="sr-only">First</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M15.707 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 010 1.414zm-6 0a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 1.414L5.414 10l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
          </inertia-link>
          <inertia-link v-if="current_page>1" :href="prev_page_url" class="relative inline-flex items-center px-2 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
            <span class="sr-only">Previous</span>
            <!-- Heroicon name: solid/chevron-left -->
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
          </inertia-link>
          <div v-for="(page,index) in pagesNumber" :key="index">
            <inertia-link :href="page.url" :class="page.active?active:no_active">
              {{page.label}}
            </inertia-link>
          </div>
          <!-- <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
            ...
          </span> -->
          <inertia-link v-if="current_page < last_page" :href="next_page_url" class="relative inline-flex items-center px-2 py-2  border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
            <span class="sr-only">Next</span>
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
          </inertia-link>
          <inertia-link v-if="current_page < last_page" :href="last_page_url" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
            <span class="sr-only">Last</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10.293 15.707a1 1 0 010-1.414L14.586 10l-4.293-4.293a1 1 0 111.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
              <path fill-rule="evenodd" d="M4.293 15.707a1 1 0 010-1.414L8.586 10 4.293 5.707a1 1 0 011.414-1.414l5 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
          </inertia-link>
        </nav>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    current_page:{
      type: Number,
    },
    first_page_url:{
      type: String,
    },
    from: {
      type: Number,
    },
    last_page: {
      type: Number,
    },
    last_page_url: {
      type: String,
    },
    next_page_url: {
      type: String,
    },
    path: {
      type: String,
    },
    per_page: {
      type: Number,
    },
    prev_page_url: {
      type: String,
    },
    to: {
      type: Number,
    },
    total: {
      type: Number,
    },
    links: {
      type: Array,
    },
    offset: {
      type: Number,
      default: 2,
    },
  },
  data() {
    return {
      active:'bg-blue-500 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium text-white hover:bg-blue-50',
      no_active:'relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50',
    };
  },
  computed: {
    pagesNumber() {
      if (!this.to) {
        return [];
      }
      var from = this.current_page - this.offset
      if(from < 1){
        from = 1
      }
      var to  = from +(this.offset*2)
      if(to >= this.last_page){
        to = this.last_page
      }
      var pagesArray = []
      while(from <= to){
        pagesArray.push(this.links[from])
        from++
      }
      return pagesArray;
    },
    classes_prev(){
      return this.current_page>1
              ? 'relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500'
              : 'invisible relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500'
    }
  },
};
</script>