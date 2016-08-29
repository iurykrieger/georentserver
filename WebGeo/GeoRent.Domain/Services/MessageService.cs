using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;
using GeoRent.Domain.Interfaces.Repository;
using GeoRent.Domain.Interfaces.Services;

namespace GeoRent.Domain.Services
{
    public class MessageService : IMessageService
    {
        private readonly IMessageRepository _messageRepository;

        public MessageService(IMessageRepository MessageRepository)
        {
            _messageRepository = MessageRepository;
        }

        public Message Add(Message obj)
        {
            return _messageRepository.Add(obj);
        }

        public void Dispose()
        {
            _messageRepository.Dispose();
            GC.SuppressFinalize(this);
        }

        public IEnumerable<Message> GetAll()
        {
            return _messageRepository.GetAll();
        }

        public Message GetById(Guid id)
        {
            return _messageRepository.GetById(id);
        }

        public void Remove(Guid id)
        {
            _messageRepository.Remove(id);
        }

        public int SaveChanges()
        {
            return _messageRepository.SaveChanges();
        }

        public Message Update(Message obj)
        {
            throw new NotImplementedException();
        }
    }
}
