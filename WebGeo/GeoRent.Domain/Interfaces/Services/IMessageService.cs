using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;

namespace GeoRent.Domain.Interfaces.Services
{
    public interface IMessageService : IDisposable
    {
        Message Add(Message obj);
        Message Update(Message obj);
        void Remove(Guid id);
        Message GetById(Guid id);
        IEnumerable<Message> GetAll();
        int SaveChanges();

    }
}