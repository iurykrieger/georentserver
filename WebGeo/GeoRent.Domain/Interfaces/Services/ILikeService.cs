using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;

namespace GeoRent.Domain.Interfaces.Services
{
    public interface ILikeService : IDisposable
    {
        Like Add(Like obj);
        Like Update(Like obj);
        void Remove(Guid id);
        Like GetById(Guid id);
        IEnumerable<Like> GetAll();
        int SaveChanges();

    }
}