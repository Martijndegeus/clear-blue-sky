import SearchForm from './components/SearchForm.vue';

// import AddBook from './components/AddBook.vue';
// import EditBook from './components/EditBook.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: SearchForm
    }
    // ,
    // {
    //     name: 'add',
    //     path: '/add',
    //     component: AddBook
    // },
    // {
    //     name: 'edit',
    //     path: '/edit/:id',
    //     component: EditBook
    // }
];
