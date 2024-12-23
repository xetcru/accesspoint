import React, { useState } from 'react';
import axios from 'axios';
import { Link } from 'react-router-dom';

const Login = () => {
  const [formData, setFormData] = useState({ email: '', password: '' });
  const [errors, setErrors] = useState({});

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });

    if (name === 'email') {
      setErrors({ ...errors, email: /\S+@\S+\.\S+/.test(value) ? '' : 'Invalid email' });
    } else if (name === 'password') {
      const isValid = value.length >= 8 && /[A-Z]/.test(value) && /[a-z]/.test(value) && /\d/.test(value);
      setErrors({ ...errors, password: isValid ? '' : 'Password must have 8+ characters, uppercase, lowercase, and a number' });
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post('/api/login', formData);
      localStorage.setItem('token', response.data.token);
      window.location.href = '/home';
    } catch (error) {
      alert('Error: ' + error.response?.data?.message || error.message);
    }
  };

  return (
    <form className="form" onSubmit={handleSubmit}>
      <input
        type="email"
        name="email"
        placeholder="Email"
        value={formData.email}
        onChange={handleChange}
        required
      />
      {errors.email && <p className="error">{errors.email}</p>}
      <input
        type="password"
        name="password"
        placeholder="Password"
        value={formData.password}
        onChange={handleChange}
        required
      />
      {errors.password && <p className="error">{errors.password}</p>}
      <button type="submit">Login</button>
      <p className="form__footer">
        Еще нет учетной записи? <Link to="/register">Регистрация</Link>
      </p>
    </form>
  );
};

export default Login;
