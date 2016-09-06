using GeoRent.Domain.Entities;
using System.Data.Entity.ModelConfiguration;

namespace GeoRent.Infra.Data.EntityConfig
{
    public class PreferenceConfig : EntityTypeConfiguration<Preference>
    {
        public PreferenceConfig()
        {
            ToTable("Preference");
        }
    }
}