using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;

namespace GeoRent.Domain.Interfaces.Services
{
    public interface IUserService: IDisposable
    {
        User Add(User obj);
        User Update(User obj);
        void Remove(Guid id);
        User GetById(Guid id);
        IEnumerable<User> GetAll();
        int SaveChanges();

    }
}