using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;
using GeoRent.Domain.Interfaces.Repository;
using GeoRent.Domain.Interfaces.Services;

namespace GeoRent.Domain.Services
{
    public class UserImageService : IUserImageService
    {
        private readonly IUserImageRepository _userImageRepository;

        public UserImageService(IUserImageRepository UserImageRepository)
        {
            _userImageRepository = UserImageRepository;
        }

        public UserImage Add(UserImage obj)
        {
            return _userImageRepository.Add(obj);
        }

        public void Dispose()
        {
            _userImageRepository.Dispose();
            GC.SuppressFinalize(this);
        }

        public IEnumerable<UserImage> GetAll()
        {
            return _userImageRepository.GetAll();
        }

        public UserImage GetById(Guid id)
        {
            return _userImageRepository.GetById(id);
        }

        public void Remove(Guid id)
        {
            _userImageRepository.Remove(id);
        }

        public int SaveChanges()
        {
            return _userImageRepository.SaveChanges();
        }

        public UserImage Update(UserImage obj)
        {
            throw new NotImplementedException();
        }
    }
}
