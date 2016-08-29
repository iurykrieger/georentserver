using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;
using GeoRent.Domain.Interfaces.Repository;
using GeoRent.Domain.Interfaces.Services;

namespace GeoRent.Domain.Services
{
    public class ResidenceService : IResidenceService
    {
        private readonly IResidenceRepository _residenceRepository;

        public ResidenceService(IResidenceRepository ResidenceRepository)
        {
            _residenceRepository = ResidenceRepository;
        }

        public Residence Add(Residence obj)
        {
            return _residenceRepository.Add(obj);
        }

        public void Dispose()
        {
            _residenceRepository.Dispose();
            GC.SuppressFinalize(this);
        }

        public IEnumerable<Residence> GetAll()
        {
            return _residenceRepository.GetAll();
        }

        public Residence GetById(Guid id)
        {
            return _residenceRepository.GetById(id);
        }

        public void Remove(Guid id)
        {
            _residenceRepository.Remove(id);
        }

        public int SaveChanges()
        {
            return _residenceRepository.SaveChanges();
        }

        public Residence Update(Residence obj)
        {
            throw new NotImplementedException();
        }
    }
}
