using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;
using GeoRent.Domain.Interfaces.Repository;
using GeoRent.Domain.Interfaces.Services;

namespace GeoRent.Domain.Services
{
    public class UserService : IUserService
    {
        private readonly IUserRepository _userRepository;

        public UserService(IUserRepository userRepository)
        {
            _userRepository = userRepository;
        }

        public User Add(User obj)
        {
            return _userRepository.Add(obj);
        }

        public IEnumerable<User> GetAll()
        {
            return _userRepository.GetAll();
        }

        public User GetById(Guid id)
        {
            return _userRepository.GetById(id);
        }

        public void Remove(Guid id)
        {
            _userRepository.Remove(id);
        }

        public int SaveChanges()
        {
            return _userRepository.SaveChanges();
        }

        public User Update(User obj)
        {
            return _userRepository.Update(obj);
        }

        public void Dispose()
        {
            _userRepository.Dispose();
            GC.SuppressFinalize(this);
        }
    }
}
