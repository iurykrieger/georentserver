using GeoRent.Domain.Entities;
using System.Data.Entity.ModelConfiguration;

namespace GeoRent.Infra.Data.EntityConfig
{
    public class ResidenceConfig : EntityTypeConfiguration<Residence>
    {
        public ResidenceConfig()
        {
            ToTable("Residence");
        }
    }
}