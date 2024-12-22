import React, { useEffect, useState } from 'react';
import axios from 'axios';

function Home() {
  const [user, setUser] = useState(null);

  useEffect(() => {
    const fetchUser = async () => {
      try {
        const token = localStorage.getItem('token');
        const response = await axios.get('/api/user', {
          headers: { Authorization: `Bearer ${token}` },
        });
        setUser(response.data);
      } catch (error) {
        alert('Error fetching user data');
      }
    };
    fetchUser();
  }, []);

  return user ? <div>Welcome, {user.name}</div> : <div>Loading...</div>;
}

export default Home;