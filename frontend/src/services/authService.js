import axios from 'axios';

const API_URL = 'http://accesspoint.gro/api/auth/';
//const API_URL = 'http://192.168.1.40/api/auth/';

const register = async (name, email, password) => {
    try {
        const response = await axios.post(API_URL + 'register', {
            name,
            email,
            password
        });
        if (response.data.token) {
            localStorage.setItem('token', response.data.token);
        }
        return response.data;
    } catch (error) {
        throw error.response.data;
    }
};

const login = async (email, password) => {
    try {
        const response = await axios.post(API_URL + 'login', {
            email,
            password
        });
        if (response.data.token) {
            localStorage.setItem('token', response.data.token);
        }
        return response.data;
    } catch (error) {
        throw error.response.data;
    }
};

const logout = () => {
    localStorage.removeItem('token');
};

export default {
    register,
    login,
    logout
};