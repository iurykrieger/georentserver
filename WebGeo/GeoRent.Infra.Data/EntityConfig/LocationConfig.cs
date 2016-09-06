using GeoRent.Domain.Entities;
using System.Data.Entity.ModelConfiguration;

namespace GeoRent.Infra.Data.EntityConfig
{
    public class LocationConfig : EntityTypeConfiguration<Location>
    {
        public LocationConfig()
        {
            ToTable("Location");
        }
    }
}