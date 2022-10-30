import api from './api';
import axios from 'axios';

const User = {
    createSession() {
        return axios.get('http://localhost:8000/sanctum/csrf-cookie');
    },
    login(params){
        return axios.post('http://localhost:8000/api/login/', params);
    },
    get(email) {
        return axios.get(`http://localhost:8000/api/users/${email}`);
        // return api.get(`api/users/${email}`);
    },
    register(user) {
        return axios.post('http://localhost:8000/api/register/', user);
        // return api.post('api/register', user);
    },
    query() {
        return api.get('api/users');
    },
    logout(){
        return axios.post('http://localhost:8000/api/logout');
    },
}

const Tool = {
    store(tool) {
        return axios.post('http://localhost:8000/api/storetools/', tool);
    },
    get(){
        return axios.get('http://localhost:8000/api/tools/');
    },
    delete(id){
        return axios.delete(`http://localhost:8000/api/tools/delete/${id}`);
    }
}

const Bookmark = {
    store(toolId){
        return axios.post(`http://localhost:8000/api/bookmarks/${toolId}`);
    }
}

export { User, Tool, Bookmark };