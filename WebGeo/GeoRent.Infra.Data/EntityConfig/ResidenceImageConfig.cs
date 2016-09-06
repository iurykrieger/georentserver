using GeoRent.Domain.Entities;
using System.Data.Entity.ModelConfiguration;

namespace GeoRent.Infra.Data.EntityConfig
{
    public class ResidenceImageConfig : EntityTypeConfiguration<ResidenceImage>
    {
        public ResidenceImageConfig()
        {
            ToTable("ResidenceImage");
        }
    }
}