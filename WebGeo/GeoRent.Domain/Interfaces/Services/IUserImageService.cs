using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;

namespace GeoRent.Domain.Interfaces.Services
{
    public interface IUserImageService : IDisposable
    {
        UserImage Add(UserImage obj);
        UserImage Update(UserImage obj);
        void Remove(Guid id);
        UserImage GetById(Guid id);
        IEnumerable<UserImage> GetAll();
        int SaveChanges();

    }
}