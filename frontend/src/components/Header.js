import React from 'react';
import { Link, useNavigate } from 'react-router-dom';

function Header() {
  const navigate = useNavigate();
  const token = localStorage.getItem('token');
  const handleLogout = () => {
    localStorage.removeItem('token');
    navigate('/login');
  };

  return (
    <header className="header">
      <div className="header__logo">AccessPoint</div>
      <nav className="header__nav">
        <Link to="/home">Домой</Link>
        {!token && <Link to="/login">Вход</Link>}
        {!token && <Link to="/register">Регистрация</Link>}
        {token && <button onClick={handleLogout}>Выход</button>}
      </nav>
    </header>
  );
}

export default Header;