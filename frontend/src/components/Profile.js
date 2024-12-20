import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import authService from '../services/authService';

function Profile() {
    const navigate = useNavigate();
    const [userData, setUserData] = useState(null);

    useEffect(() => {
        const token = localStorage.getItem('token');
        if (!token) {
            navigate('/login');
        }
    }, [navigate]);

    const handleLogout = () => {
        authService.logout();
        navigate('/login');
    };

    return (
        <div className="profile">
            <h2>Профиль пользователя</h2>
            {userData && (
                <div>
                    <p>Имя: {userData.name}</p>
                    <p>Email: {userData.email}</p>
                </div>
            )}
            <button onClick={handleLogout}>Выйти</button>
        </div>
    );
}

export default Profile;