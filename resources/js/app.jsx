//import React from 'react';
//import ReactDOM from 'react-dom';
import React, { useEffect, useState } from 'react';
import axios from 'axios';

//const App = () => <h1>Hello from React in Laravel!</h1>;
const App = () => {
    const [data, setData] = useState([]);

    useEffect(() => {
        axios.post('/api/auth/register', {
            name: 'Test User',
            email: 'test@example.com',
            password: 'Password123',
        }).then(response => {
            console.log(response.data);
        }).catch(error => {
            console.error(error);
        });
    }, []);

    return <div>Check Console for API Response</div>;
};

//ReactDOM.render(<App />, document.getElementById('root'));
export default App;