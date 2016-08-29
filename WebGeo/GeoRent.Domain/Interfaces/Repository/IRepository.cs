using System;
using System.Collections.Generic;

namespace GeoRent.Domain.Interfaces.Repository
{
    public interface IRepository<TEntity> : IDisposable where TEntity : class
    {
        TEntity Add(TEntity obj);
        TEntity Update(TEntity obj);
        void Remove(Guid id);
        TEntity GetById(Guid id);
        IEnumerable<TEntity> GetAll();
        int SaveChanges();
    }
}