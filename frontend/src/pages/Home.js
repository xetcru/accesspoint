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

  return (
    <div className="home">
      {user ? <h1>Добро подаловать. Снова.</h1> : <p>Loading...</p>}
    </div>
  );
}

export default Home;